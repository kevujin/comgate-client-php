<?php
declare(strict_types=1);

namespace Comgate\Response;

use Comgate\Enum\ResponseCode;
use Comgate\Exception\InvalidArgumentException;
use Comgate\Response\Item\Method;

class GetMethods extends BaseResponse
{
    /**
     * @var Method[]
     */
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

        $this->methods = array_map(function ($item) {
            return new Method($item);
        }, $data['methods'] ?? []);
    }

    public function getMethod($id) : ?Method
    {
        foreach ($this->methods as $method) {
            if ($method->id == $id) {
                return $method;
            }
        }

        return null;
    }
}
