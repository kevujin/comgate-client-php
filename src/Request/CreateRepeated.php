<?php
declare(strict_types=1);

namespace Comgate\Request;

use Comgate\Client;
use Comgate\Response\CreateRepeated as CreateRepeatedResponse;

/**
 * Class CreateRecurring
 * @package Comgate\Request
 *
 */
class CreateRepeated extends BaseRequest
{
    protected static $endpoint = 'recurring';

    protected static $mandatory_fields = [
        'price',
        'refId',
        'email',
        'curr',
        'label',
        'initRecurringId',
    ];

    protected static $optional_fields = [
        'country',
        'payerId',
        'account',
        'phone',
        'name',
        'prepareOnly',
        'eetReport',
        'eetData',
    ];

    /**
     * @var string
     */
    protected $initRecurringId;


    public function __construct(
        int $price,
        string $refId,
        string $email,
        string $label,
        string $initRecurringId,
        string $curr = 'CZK'
    ) {
        $this->setPrepareOnly(true)
            ->setPrice($price)
            ->setRefId($refId)
            ->setEmail($email)
            ->setLabel($label)
            ->setCurr($curr);
        $this->setInitRecurringId($initRecurringId);
    }


    /**
     * @return string
     */
    public function getInitRecurringId(): string
    {
        return $this->initRecurringId;
    }


    /**
     * @param string $initRecurringId
     * @return self
     */
    public function setInitRecurringId(string $initRecurringId): self
    {
        $this->initRecurringId = $initRecurringId;

        return $this;
    }


    /**
     * @throws \Comgate\Exception\ErrorCodeException
     * @throws \Comgate\Exception\InvalidArgumentException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send(Client $client): CreateRepeatedResponse
    {
        return $client->send($this);
    }


    /**
     * @throws \Comgate\Exception\ErrorCodeException
     * @throws \Comgate\Exception\InvalidArgumentException
     */
    public function getResponseObject(string $rawData): CreateRepeatedResponse
    {
        return new CreateRepeatedResponse($rawData);
    }
}
