<?php namespace KlarnaKco;

/**
 * Klarna Checkout Session
 *
 * @package KlarnaKco
 */
class Session extends \KlarnaCore\Resource
{
    /**
     * Get session details
     *
     * @param string $id
     *
     * @see https://developers.klarna.com/api/#checkout-api-retrieve-an-order
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function get($id)
    {
        return $this->client->get(sprintf('checkout/v3/orders/%s', $id));
    }

    /**
     * Create new session
     *
     * @param array $data
     *
     * @see https://developers.klarna.com/api/#checkout-api-create-a-new-order
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function create(array $data)
    {
        return $this->client->post('checkout/v3/orders', [
            'json' => $data
        ]);
    }

    /**
     * Update session details
     *
     * @param string $id
     * @param array  $data
     *
     * @see https://developers.klarna.com/api/#checkout-api-update-an-order
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function update($id, array $data)
    {
        return $this->client->post(sprintf('checkout/v3/orders/%s', $id), [
            'json' => $data
        ]);
    }
}