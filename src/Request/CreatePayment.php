<?php
declare(strict_types=1);

namespace Comgate\Request;

use Comgate\Client;
use Comgate\Enum\Method;
use Comgate\Response\CreatePayment as CreatePaymentResponse;

/**
 * Class CreatePayment
 * @package Comgate\Request
 *
 */
class CreatePayment extends BaseRequest
{
    protected static $endpoint = 'create';

    protected static $mandatory_fields = [
        'price',
        'refId',
        'email',
        'method',
        'curr',
        'label'
    ];

    protected static $optional_fields = [
        'country',
        'payerId',
        'account',
        'phone',
        'name',
        'lang',
        'prepareOnly',
        'preauth',
        'initRecurring',
        'verification',
        'embedded',
        'eetReport',
        'eetData',
    ];

    /**
     * CreatePayment constructor.
     * @param int $price
     * @param string $refId
     * @param string $email
     * @param string $label
     * @param string $method
     * @param string $curr
     * @throws \Comgate\Exception\LabelTooLongException
     */
    public function __construct(
        int $price,
        string $refId,
        string $email,
        string $label,
        string $method = Method::ALL,
        string $curr = 'CZK'
    ) {
        $this->setPrice($price);
        $this->setRefId($refId);
        $this->setEmail($email);
        $this->setLabel($label);
        $this->setMethod($method);
        $this->setCurr($curr);
    }

    /**
     * @param Client $client
     * @return CreatePaymentResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Comgate\Exception\ErrorCodeException
     * @throws \Comgate\Exception\InvalidArgumentException
     */
    public function send(Client $client): CreatePaymentResponse
    {
        return $client->send($this);
    }

    /**
     * @throws \Comgate\Exception\ErrorCodeException
     * @throws \Comgate\Exception\InvalidArgumentException
     */
    public function getResponseObject(string $rawData): CreatePaymentResponse
    {
        return new CreatePaymentResponse($rawData);
    }
}
