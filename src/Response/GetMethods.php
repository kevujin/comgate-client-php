<?php
declare(strict_types=1);

namespace Comgate\Response;

use Comgate\Exception\InvalidArgumentException;

class GetMethods extends BaseResponse
{

    private array $data;

    /**
     * @param array $rawData
     * @throws InvalidArgumentException
     * @throws ErrorCodeException
     */
    public function __construct(array $rawData)
    {
        if (!isset($rawData['error'])) {
            // simulate success as this is expected
            $rawData['code'] = 200;
            $rawData['message'] = 'OK';
        } else {
            $rawData = $rawData['error'];
            $rawData['message'] .= ' / ' . $rawData['extraMessage'] ?? '-';
        }

        parent::__construct($rawData);

        $this->data = $rawData;
    }

    public function getData(): array
    {
        return $this->data;
    }
}
