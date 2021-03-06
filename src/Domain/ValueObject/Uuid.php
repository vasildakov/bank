<?php

declare(strict_types = 1);

namespace Domain\ValueObject;

class Uuid
{
    /**
     * Matches Uuid's versions 1 to 5.
     */
    const REGEX_UUID = '/^[0-9A-Fa-f]{8}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{4}-[0-9A-Fa-f]{12}$/';

    /**
     * @var string
     */
    private $value;

    /**
     * @param string $value
     */
    public function __construct($value)
    {
        if (!\preg_match(self::REGEX_UUID, $value)) {
            throw new \InvalidArgumentException;
        }

        $this->value = $value;
    }

    public function equals(Uuid $other)
    {
        return strtolower((string) $this) === strtolower((string) $other);
    }

    public function __toString()
    {
        return (string) $this->value;
    }
}
