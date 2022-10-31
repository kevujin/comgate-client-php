<?php
declare(strict_types=1);

namespace Comgate\Response;

class PaymentStatus extends BaseResponse
{
    public string $merchant;

    public bool $test;

    public int $price;

    public string $curr;

    public string $label;

    public string $refId;

    public ?string $payerId = null;

    public ?string $method = null;

    public ?string $account = null;

    public string $email;

    public ?string $phone = null;

    public ?string $name = null;

    public string $transId;

    public string $secret;

    public string $status;

    public ?string $payerName = null;

    public ?string $payerAcc = null;

    public ?string $fee = null;

    public function __construct(string $rawData)
    {
        $data = $this->parseInput($rawData);

        $reflect = new \ReflectionClass($this);
        $props   = $reflect->getProperties(\ReflectionProperty::IS_PUBLIC | \ReflectionProperty::IS_PROTECTED);
        foreach ($props as $prop) {
            $name = $prop->getName();
            if (!array_key_exists($name, $data)) {
                continue;
            }

            $value = $data[$name];
            $type = $prop->getType();
            if ($type instanceof \ReflectionNamedType) {
                if ('bool' === $type->getName()) {
                    $value = $value === 'true' ? true : false;
                } else {
                    settype($value, $type->getName());
                }
            }

            $this->$name = $value;
        }

        parent::__construct($data);
    }
}
