<?php
declare(strict_types=1);

namespace Comgate\Response;

use Comgate\Exception\ErrorCodeException;
use Comgate\Exception\InvalidArgumentException;

class CreatePayment extends BaseResponse
{
    private string $transId;

    private string $redirect;

    /**
     * @throws InvalidArgumentException
     * @throws ErrorCodeException
     */
    public function __construct(string $rawData)
    {
        $data = $this->parseInput($rawData);

        parent::__construct($data);

        if (isset($data['transId'])) {
            $this->transId = $data['transId'];
        } else {
            throw new InvalidArgumentException('Missing "transId" in response');
        }

        if (isset($data['redirect'])) {
            $this->redirect = $data['redirect'];
        } else {
            throw new InvalidArgumentException('Missing "redirect" in response');
        }
    }

    public function getTransId(): string
    {
        return $this->transId;
    }

    public function getRedirectUrl(): string
    {
        return $this->redirect;
    }
}
