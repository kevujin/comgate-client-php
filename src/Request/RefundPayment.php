<?php
declare(strict_types=1);

namespace Comgate\Request;

use Comgate\Client;
use Comgate\Response\RefundPayment as RefundPaymentResponse;

/**
 * Class RefundPayment
 * @package Comgate\Request
 *
 */
class RefundPayment extends BaseRequest
{
    protected static $endpoint = 'refund';

    protected static $mandatory_fields = [
        'amount',
        'transId',
    ];

    protected static $optional_fields = [
        'curr'
    ];

    /**
     * @var int
     */
    protected $amount;

    /**
     * @var string
     */
    protected $transId;

    /**
     * RefundPayment constructor.
     * @param int $amount
     * @param string $transId
     * @param string|null $curr
     */
    public function __construct(int $amount, string $transId, string $curr = 'CZK')
    {
        $this->setAmount($amount)
            ->setTransId($transId)
            ->setCurr($curr);
    }


    /**
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }


    /**
     * @param int $amount
     * @return RefundPayment
     */
    public function setAmount(int $amount): RefundPayment
    {
        $this->amount = $amount;
        return $this;
    }


    /**
     * @return string
     */
    public function getTransId(): string
    {
        return $this->transId;
    }


    /**
     * @param string $transId
     * @return RefundPayment
     */
    public function setTransId(string $transId): RefundPayment
    {
        $this->transId = $transId;
        return $this;
    }

    /**
     * @throws \Comgate\Exception\ErrorCodeException
     * @throws \Comgate\Exception\InvalidArgumentException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send(Client $client): RefundPaymentResponse
    {
        return $client->send($this);
    }


    /**
     * @throws \Comgate\Exception\ErrorCodeException
     * @throws \Comgate\Exception\InvalidArgumentException
     */
    public function getResponseObject(string $rawData): RefundPaymentResponse
    {
        return new RefundPaymentResponse($rawData);
    }
}
