<?php namespace KlarnaKco;

use KlarnaKco\Traits\Arrayable;
use KlarnaKco\Traits\PropertyOverload;

/**
 * Class ExternalPaymentMethods
 *
 * @package KlarnaKco
 */
class ExternalPaymentMethod implements Contracts\Model
{
    use Arrayable;
    use PropertyOverload;

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->data;
    }
}
