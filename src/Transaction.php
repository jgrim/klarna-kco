<?php namespace KlarnaKco;

use KlarnaKco\Traits\Arrayable;
use KlarnaKco\Traits\PropertyOverload;

/**
 * Class Transaction
 *
 * @property string                      $purchase_country
 * @property string                      $purchase_currency
 * @property string                      $locale
 * @property string                      $merchant_reference1
 * @property string                      $merchant_reference2
 * @property array|Address               $billing_address
 * @property array|Address               $shipping_address
 * @property array|Customer              $customer
 * @property array|Options               $options
 * @property array|MerchantUrls          $merchant_urls
 * @property array|ShippingOption        $shipping_options
 * @property array|ExternalCheckouts     $external_checkouts
 * @property array|ExternalPaymentMethod $external_payment_methods
 *
 * @package KlarnaKco
 */
class Transaction
{
    use Arrayable;
    use PropertyOverload;

    /**
     * @var ItemCollection
     */
    protected $orderLine;

    /**
     * @var float
     */
    protected $orderAmount;

    /**
     * @var float
     */
    protected $orderTaxAmount;

    /**
     * Transaction constructor.
     *
     * @param array $data
     */
    public function __construct($data = array())
    {
        $this->data      = $data;
        $this->orderLine = new ItemCollection();
    }

    /**
     * @return array
     */
    public function getTransactionItems()
    {
        $transactionItems = $this->data;

        array_walk($transactionItems, function (&$value, $key) {
            if ($value instanceof Arrayable) {
                $value = $value->toArray();
            }
        });

        return $transactionItems;
    }

    /**
     * @param $item
     *
     * @return $this
     */
    public function addOrderLine(OrderLine $item)
    {
        $this->orderAmount += $item->getTotalAmount();

        if (OrderLine::TYPE_SALES_TAX == $item->getType()) {
            $this->orderTaxAmount = $item->getTotalAmount();
        } else {
            $this->orderTaxAmount += $item->getTotalTaxAmount();
        }

        $this->orderLine->addItem($item);

        return $this;
    }

    /**
     * Remove item
     *
     * @param mixed $reference
     *
     * @return $this
     */
    public function removeOrderLine($reference)
    {
        if (isset($this->orderLine[$reference])) {
            $this->orderAmount    -= $this->orderLine[$reference]->getTotalAmount();
            $this->orderTaxAmount -= $this->orderLine[$reference]->getTotalTaxAmount();
            unset($this->orderLine[$reference]);
        }

        return $this;
    }

    /**
     * @return ItemCollection
     */
    public function getOrderLines()
    {
        return $this->orderLine;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return array_merge($this->getTransactionItems(), array(
            'order_lines'      => $this->getOrderLines()->toArray(),
            'order_amount'     => $this->orderAmount,
            'order_tax_amount' => $this->orderTaxAmount,
        ));
    }
}
