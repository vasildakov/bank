<?php

declare(strict_types = 1);

namespace Domain\ValueObject;

class Currency
{
    private $code;

    public function __construct($code)
    {
        $this->code = $code;
    }
}
