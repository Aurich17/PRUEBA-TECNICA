<?php
namespace Tests\Unit\Domain;

use PHPUnit\Framework\TestCase;
use Domain\Entity\User;
use Domain\ValueObject\UserId;
use Domain\ValueObject\Name;
use Domain\ValueObject\Email;
use Domain\ValueObject\Password;

final class UserTest extends TestCase
{
    public function testCrearUsuario(): void
    {
        $userId   = new UserId();
        $name     = new Name('Juan Pérez');
        $email    = new Email('juan@example.com');
        $password = new Password('Password!1');

        $user = new User($userId, $name, $email, $password);

        $this->assertEquals('juan@example.com', (string)$user->getEmail());
    }
}
