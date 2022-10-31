<?php
declare(strict_types=1);

namespace Comgate\Response;

use Comgate\Enum\ResponseCode;
use Comgate\Exception\ErrorCodeException;
use Comgate\Exception\InvalidArgumentException;

abstract class BaseResponse
{
    /**
     * @var int
     */
    private $code;

    /**
     * @var string
     */
    private $message;

    /**
     * @throws InvalidArgumentException
     * @throws ErrorCodeException
     */
    public function __construct($rawData)
    {
        if (is_string($rawData)) {
            $data = $this->parseInput($rawData);
        } else {
            $data = (array) $rawData;
        }

        if (isset($data['code'])) {
            $this->code = (int) $data['code'];
        } else {
            throw new InvalidArgumentException('Missing "code" in response');
        }

        if (isset($data['message'])) {
            $this->message = $data['message'];
        } else {
            throw new InvalidArgumentException('Missing "message" in response');
        }

        if (!$this->isOk()) {
            throw new ErrorCodeException($this->message, $this->code);
        }
    }

    protected function parseInput(string $rawData)
    {
        parse_str($rawData, $data);

        return $data;
    }

    public function isOk(): bool
    {
        return $this->code === ResponseCode::CODE_OK;
    }

    public function getCode(): int
    {
        return $this->code;
    }

    public function getMessage(): string
    {
        return $this->message;
    }
}
