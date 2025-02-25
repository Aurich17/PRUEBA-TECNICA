<?php
namespace Domain\ValueObject;

use InvalidArgumentException;

final class Email
{
    private string $value;

    public function __construct(string $value)
    {
        $trimmed = trim($value);
        if (!filter_var($trimmed, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("Email inválido.");
        }
        $this->value = $trimmed;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}