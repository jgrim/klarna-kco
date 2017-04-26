<?php namespace KlarnaKco;

use KlarnaKco\Contracts\Model;
use KlarnaKco\Traits\Arrayable;
use KlarnaKco\Traits\PropertyOverload;

abstract class ModelAbstract implements Model
{
    use Arrayable;
    use PropertyOverload;

    public function __construct($data = array())
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->data;
    }
}
