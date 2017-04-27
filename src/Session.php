<?php namespace KlarnaKco;

/**
 * Copyright 2017 Jason Grim
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 *
 * @package    KlarnaKco
 * @author     Jason Grim <me@jasongrim.com>
 */

use KlarnaCore\Resource;
use KlarnaCore\Transaction;

/**
 * Klarna Checkout Session
 *
 * @package KlarnaKco
 */
class Session extends Resource
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
     * @param array|Transaction $data
     *
     * @see https://developers.klarna.com/api/#checkout-api-create-a-new-order
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function create($data)
    {
        if ($data instanceof Transaction) {
            $data = $data->toArray();
        }

        if (!is_array($data)) {
            throw new \InvalidArgumentException('Data must be an array.');
        }

        return $this->client->post('checkout/v3/orders', [
            'json' => $data
        ]);
    }

    /**
     * Update session details
     *
     * @param string            $id
     * @param array|Transaction $data
     *
     * @see https://developers.klarna.com/api/#checkout-api-update-an-order
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function update($id, $data)
    {
        if ($data instanceof Transaction) {
            $data = $data->toArray();
        }

        if (!is_array($data)) {
            throw new \InvalidArgumentException('Data must be an array.');
        }

        return $this->client->post(sprintf('checkout/v3/orders/%s', $id), [
            'json' => $data
        ]);
    }
}
