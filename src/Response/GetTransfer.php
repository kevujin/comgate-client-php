<?php
declare(strict_types=1);

namespace Comgate\Response;

use Comgate\Enum\ResponseCode;
use Comgate\Exception\InvalidArgumentException;
use Comgate\Response\Item\TransferItem;

class GetTransfer extends BaseResponse
{
    /**
     * @var TransferItem[]
     */
    public array $transferItems = [];

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

            $this->transferItems = array_map(function ($item) {
                return new TransferItem($item);
            }, $data['transfers'] ?? []);
        }

        parent::__construct($data);
    }
}
