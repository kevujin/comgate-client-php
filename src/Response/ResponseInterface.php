<?php

namespace Comgate\Response;

interface ResponseInterface
{
    public function isOk(): bool;

    public function getCode(): int;

    public function getMessage(): string;
}
