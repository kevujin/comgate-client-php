<?php
declare(strict_types=1);

namespace Comgate\Request;

use Comgate\Client;
use Comgate\Response\CancelPayment as CancelPaymentResponse;

class PaymentStatus extends BaseRequest
{
    protected static $endpoint = 'cancel';

    protected static $mandatory_fields = [
        'transId',
    ];

    /**
     * @var string
     */
    protected $transId;

    public function __construct(string $transId)
    {
        $this->transId = $transId;
    }


    /**
     * @throws \Comgate\Exception\ErrorCodeException
     * @throws \Comgate\Exception\InvalidArgumentException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send(Client $client): CancelPaymentResponse
    {
        return $client->send($this);
    }


    /**
     * @throws \Comgate\Exception\ErrorCodeException
     * @throws \Comgate\Exception\InvalidArgumentException
     */
    public function getResponseObject(string $rawData): CancelPaymentResponse
    {
        return new CancelPaymentResponse($rawData);
    }
}
