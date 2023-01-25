<?php
declare(strict_types=1);

namespace Comgate\Request;

use Comgate\Client;
use Comgate\Response\GetTransfer as GetTransferResponse;

class GetTransfer extends BaseRequest
{
    protected static $endpoint = 'singleTransfer';

    protected static $mandatory_fields = [
        'transferId'
    ];

    protected int $transferId;

    public function __construct(int $transferId)
    {
        $this->transferId = $transferId;
    }

    public function isPost(): bool
    {
        return false;
    }

    /**
     * @throws \Comgate\Exception\ErrorCodeException
     * @throws \Comgate\Exception\InvalidArgumentException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send(Client $client): GetTransferResponse
    {
        return $client->send($this);
    }

    /**
     * @throws \Comgate\Exception\ErrorCodeException
     * @throws \Comgate\Exception\InvalidArgumentException
     */
    public function getResponseObject(string $rawData): GetTransferResponse
    {
        return new GetTransferResponse($rawData);
    }

}
