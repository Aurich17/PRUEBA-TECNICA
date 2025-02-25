<?php
namespace Domain\ValueObject;

use InvalidArgumentException;

final class Name
{
    private string $value;
    private const MIN_LENGTH = 2;
    private const PATTERN = '/^[\p{L}\s]+$/u';

    public function __construct(string $value)
    {
        $trimmed = trim($value);
        if (strlen($trimmed) < self::MIN_LENGTH) {
            throw new InvalidArgumentException("El nombre debe tener al menos " . self::MIN_LENGTH . " caracteres.");
        }
        if (!preg_match(self::PATTERN, $trimmed)) {
            throw new InvalidArgumentException("El nombre contiene caracteres no permitidos.");
        }
        $this->value = $trimmed;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}