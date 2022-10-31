<?php
declare(strict_types=1);

namespace Comgate\Response;

use Comgate\Enum\ResponseCode;
use Comgate\Exception\InvalidArgumentException;

class GetMethods extends BaseResponse
{
    public array $methods = [];

    /**
     * @throws InvalidArgumentException
     * @throws ErrorCodeException
     */
    public function __construct(string $rawData)
    {
        $data = json_decode($rawData, true);

        if (!isset($data['error'])) {
            // simulate success as this is expected
            $data['code'] = ResponseCode::CODE_OK;
            $data['message'] = 'OK';
        } else {
            $data = $data['error'];
            $data['message'] .= ' / ' . ($data['extraMessage'] ?? '-');
        }

        parent::__construct($data);

        $this->methods = $data['methods'] ?? [];
    }
}
