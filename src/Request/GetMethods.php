<?php
declare(strict_types=1);

namespace Comgate\Request;

use Comgate\Response\GetMethods as GetMethodsResponse;

class GetMethods extends BaseRequest
{
    protected static $endpoint = 'methods';

    protected static $mandatory_fields = [
        'curr',
        'country'
    ];

    /**
     * @param string|null $curr
     * @param string|null $country
     *
     */
    public function __construct($curr = null, $country = null)
    {
        $this->curr = $curr;
        $this->country = $country;
    }

    public function getData(): array
    {
        $data = parent::getData();
        
        $data['type'] = 'json';
        
        return $data;
    }

    public function isPost(): bool
    {
        return false;
    }

  /**
     * @param array $rawData
     * @throws \Comgate\Exception\ErrorCodeException
     * @throws \Comgate\Exception\InvalidArgumentException
     */
    public function getResponseObject(array $rawData): GetMethodsResponse
    {
        return new GetMethodsResponse($rawData);
    }

}
