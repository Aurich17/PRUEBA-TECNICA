<?php
namespace Domain\ValueObject;

use Shared\Exception\WeakPasswordException;

final class Password
{
    private string $hashed;
    private const PATTERN = '/^(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';

    public function __construct(string $plainPassword)
    {
        if (!preg_match(self::PATTERN, $plainPassword)) {
            throw new WeakPasswordException("La contraseña no cumple los requisitos de seguridad.");
        }
        $this->hashed = password_hash($plainPassword, PASSWORD_BCRYPT);
    }

    public function verify(string $plainPassword): bool
    {
        return password_verify($plainPassword, $this->hashed);
    }

    public function __toString(): string
    {
        return $this->hashed;
    }
}
