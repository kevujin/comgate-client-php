<?php
declare(strict_types=1);

namespace Comgate\Enum;

class TransferItem
{
    const PAYMENT = 1;
    const REFUND = 2;
    const MONTHLY_FEE = 3;
    const OTHER = 4;
    const SUM = 5;
}
