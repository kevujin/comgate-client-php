<?php

namespace Comgate\Response\Item;

use Comgate\Request\GetTransfer;

class Transfer extends BaseItem
{
    public int $transferId;
    public string $transferDate;
    public string $accountCounterparty;
    public string $accountOutgoing;
    public string $variableSymbol;

    public function createRequest()
    {
        return new GetTransfer($this->transferId);
    }
}
