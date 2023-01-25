<?php
declare(strict_types=1);

namespace Comgate\Response;

use Comgate\Enum\ResponseCode;
use Comgate\Exception\InvalidArgumentException;
use Comgate\Response\Item\Transfer;

class ListTransfers extends BaseResponse
{
    /**
     * @var Transfer[]
     */
    public array $transfers = [];

    /**
     * @throws InvalidArgumentException
     * @throws ErrorCodeException
     */
    public function __construct(string $rawData)
    {
        $data = json_decode($rawData, true);

        if (!isset($data['code'])) {
            $data = [
                'transfers' => $data,
                // simulate success as this is expected in parent class
                'code' => ResponseCode::CODE_OK,
                'message' => 'OK'
            ];

            $this->transfers = array_map(function ($item) {
                return new Transfer($item);
            }, $data['transfers'] ?? []);
        }

        parent::__construct($data);
    }
}
