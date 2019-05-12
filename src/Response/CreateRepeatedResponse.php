<?php
declare(strict_types=1);

namespace Comgate\Response;

use Comgate\Exception\ErrorCodeException;
use Comgate\Exception\InvalidArgumentException;

class CreateRepeatedResponse extends BaseResponse
{
    /**
     * @var string
     */
    private $transId;

    /**
     * @param array $rawData
     * @throws InvalidArgumentException
     * @throws ErrorCodeException
     */
    public function __construct(array $rawData)
    {

        parent::__construct($rawData);

        if (isset($rawData['transId'])) {
            $this->transId = $rawData['transId'];
        } else {
            throw new InvalidArgumentException('Missing "transId" in response');
        }
    }


    /**
     * @return string
     */
    public function getTransId(): string
    {
        return $this->transId;
    }
}
