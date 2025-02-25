<?php
namespace Tests\Unit\ValueObject;

use PHPUnit\Framework\TestCase;
use Domain\ValueObject\Password;
use Shared\Exception\WeakPasswordException;

final class PasswordTest extends TestCase
{
    public function testCreaPasswordValido(): void
    {
        $plain = 'Password!1';
        $password = new Password($plain);

        $this->assertNotEquals($plain, (string)$password);

        $this->assertTrue($password->verify($plain));
    }

    public function testLanzaExcepcionParaPasswordDebil(): void
    {
        $this->expectException(WeakPasswordException::class);
        new Password('debil');
    }
}