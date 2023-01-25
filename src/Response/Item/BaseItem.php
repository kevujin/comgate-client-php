<?php

namespace Comgate\Response\Item;

class BaseItem
{
    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }
}
