<?php
declare(strict_types=1);

namespace Comgate\Request;

use Comgate\Response\BaseResponse;

interface RequestInterface
{
    public function getData(): array;

    public function isPost(): bool;

    public function getEndPoint(): string;

    public function getResponseObject(string $data): BaseResponse;
}
