<?php

namespace Comgate\Response\Item;

class TransferItem extends BaseItem
{
    public array $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getType()
    {
        return $this->data['typ'];
    }

    public function getTransId()
    {
        return $this->data['ID ComGate'];
    }

    public function getId()
    {
        return $this->data['ID od klienta'];
    }
}
