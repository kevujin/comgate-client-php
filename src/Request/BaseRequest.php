<?php
declare(strict_types=1);

namespace Comgate\Request;

use Comgate\Exception\LabelTooLongException;

abstract class BaseRequest implements RequestInterface
{
    /**
     * @var int
     */
    private $price;

    /**
     * @var string
     */
    private $refId;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $label;

    /**
     * @var string
     */
    private $method;

    /**
     * @var string
     */
    private $curr;

    /**
     * @var string (default is 'CZ')
     */
    private $country;

    /**
     * @var string (user identifier for saved card info)
     */
    private $payerId;

    /**
     * @var string
     */
    private $account;

    /**
     * @var string
     */
    private $phone;

    /**
     * @var string (product identifier)
     */
    private $name;

    /**
     * @var string (lang ISO-639-1, default='cs')
     */
    private $lang;

    /**
     * @var bool (true = background create; false = create with redirect)
     */
    private $prepareOnly;

    /**
     * @var bool
     */
    private $preauth;

    /**
     * @var bool
     */
    private $initRecurring;

    /**
     * @var bool
     */
    private $verification;

    /**
     * @var bool
     */
    private $embedded;

    /**
     * @var bool
     */
    private $eetReport;

    /**
     * @var string (JSON)
     */
    private $eetData;


    /**
     * @var string
     */
    protected static $endpoint;

    /**
     * @var array
     */
    protected static $mandatory_fields = [];

    /**
     * @var array
     */
    protected static $optional_fields = [];


    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }


    /**
     * @param int $price
     * @return self
     */
    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }


    /**
     * @return string
     */
    public function getRefId(): string
    {
        return $this->refId;
    }


    /**
     * @param string $refId
     * @return self
     */
    public function setRefId(string $refId): self
    {
        $this->refId = $refId;

        return $this;
    }


    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }


    /**
     * @param string $email
     * @return self
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }


    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     * @return self
     * @throws LabelTooLongException
     */
    public function setLabel(string $label): self
    {
        if (mb_strlen($label) > 16) {
            throw new LabelTooLongException('Product label is too long. Max length is 16 chars');
        }
        $this->label = $label;

        return $this;
    }


    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }


    /**
     * @param string $method
     * @return self
     */
    public function setMethod(string $method): self
    {
        $this->method = $method;

        return $this;
    }


    /**
     * @return string
     */
    public function getCurr(): string
    {
        return $this->curr;
    }


    /**
     * @param string $curr
     * @return self
     */
    public function setCurr(string $curr): self
    {
        $this->curr = $curr;

        return $this;
    }


    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }


    /**
     * @param string $country
     * @return self
     */
    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }


    /**
     * @return string
     */
    public function getPayerId(): string
    {
        return $this->payerId;
    }


    /**
     * @param string $payerId
     * @return self
     */
    public function setPayerId(string $payerId): self
    {
        $this->payerId = $payerId;

        return $this;
    }


    /**
     * @return string
     */
    public function getAccount(): string
    {
        return $this->account;
    }


    /**
     * @param string $account
     * @return self
     */
    public function setAccount(string $account): self
    {
        $this->account = $account;

        return $this;
    }


    /**
     * @return string
     */
    public function getPhone(): string
    {
        return $this->phone;
    }


    /**
     * @param string $phone
     * @return self
     */
    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }


    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }


    /**
     * @param string $name
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }


    /**
     * @return string
     */
    public function getLang(): string
    {
        return $this->lang;
    }


    /**
     * @param string $lang
     * @return self
     */
    public function setLang(string $lang): self
    {
        $this->lang = $lang;

        return $this;
    }


    /**
     * @return bool
     */
    public function isPrepareOnly(): bool
    {
        return $this->prepareOnly;
    }


    /**
     * @param bool $prepareOnly
     * @return self
     */
    public function setPrepareOnly(bool $prepareOnly): self
    {
        $this->prepareOnly = $prepareOnly;

        return $this;
    }


    /**
     * @return bool
     */
    public function isPreauth(): bool
    {
        return $this->preauth;
    }


    /**
     * @param bool $preauth
     * @return self
     */
    public function setPreauth(bool $preauth): self
    {
        $this->preauth = $preauth;

        return $this;
    }


    /**
     * @return bool
     */
    public function isInitRecurring(): bool
    {
        return $this->initRecurring;
    }


    /**
     * @param bool $initRecurring
     * @return self
     */
    public function setInitRecurring(bool $initRecurring): self
    {
        $this->initRecurring = $initRecurring;

        return $this;
    }


    /**
     * @return bool
     */
    public function isVerification(): bool
    {
        return $this->verification;
    }


    /**
     * @param bool $verification
     * @return self
     */
    public function setVerification(bool $verification): self
    {
        $this->verification = $verification;

        return $this;
    }


    /**
     * @return bool
     */
    public function isEmbedded(): bool
    {
        return $this->embedded;
    }


    /**
     * @param bool $embedded
     * @return self
     */
    public function setEmbedded(bool $embedded): self
    {
        $this->embedded = $embedded;

        return $this;
    }


    /**
     * @return bool
     */
    public function isEetReport(): bool
    {
        return $this->eetReport;
    }


    /**
     * @param bool $eetReport
     * @return self
     */
    public function setEetReport(bool $eetReport): self
    {
        $this->eetReport = $eetReport;

        return $this;
    }


    /**
     * @return string
     */
    public function getEetData(): string
    {
        return $this->eetData;
    }


    /**
     * @param string $eetData
     * @return self
     */
    public function setEetData(string $eetData): self
    {
        $this->eetData = $eetData;

        return $this;
    }


    /**
     * @return array
     */
    public function getData(): array
    {
        $data = [];
        foreach (static::$mandatory_fields as $field) {
            if (is_bool($this->$field)) {
                $data[$field] = $this->$field ? 'true' : 'false';
            } else {
                $data[$field] = $this->$field;
            }
        }

        foreach (static::$optional_fields as $field) {
            if ($this->$field !== null) {
                if (is_bool($this->$field)) {
                    $data[$field] = $this->$field ? 'true' : 'false';
                } else {
                    $data[$field] = $this->$field;
                }
            }
        }

        return $data;
    }


    /**
     * @return bool
     */
    public function isPost(): bool
    {
        return true;
    }


    /**
     * @return string
     */
    public function getEndPoint(): string
    {
        return static::$endpoint;
    }
}
