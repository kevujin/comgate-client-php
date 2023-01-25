<?php
declare(strict_types=1);

namespace Comgate\Request;

use Comgate\Client;
use Comgate\Response\ListTransfers as ListTransfersResponse;

class ListTransfers extends BaseRequest
{
    protected static $endpoint = 'transferList';

    protected static $mandatory_fields = [
        'date'
    ];

    protected string $date;

    public function __construct(string $date)
    {
        $this->date = $date;
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
    public function send(Client $client): ListTransfersResponse
    {
        return $client->send($this);
    }

    /**
     * @throws \Comgate\Exception\ErrorCodeException
     * @throws \Comgate\Exception\InvalidArgumentException
     */
    public function getResponseObject(string $rawData): ListTransfersResponse
    {
        return new ListTransfersResponse($rawData);
    }

}
