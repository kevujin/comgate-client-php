<?php
declare(strict_types=1);

namespace Comgate\Request;

interface RequestInterface
{

    /**
     * @return array
     */
    public function getData(): array;


    /**
     * @return bool
     */
    public function isPost(): bool;


    /**
     * @return string
     */
    public function getEndPoint(): string;


    public function getResponseObject(array $data);
}
