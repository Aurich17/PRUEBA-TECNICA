<?php
namespace Tests\Unit\ValueObject;

use PHPUnit\Framework\TestCase;
use Domain\ValueObject\Email;
use InvalidArgumentException;

final class EmailTest extends TestCase
{
    public function testCreaEmailValido(): void
    {
        $email = new Email('juan@example.com');
        $this->assertEquals('juan@example.com', (string)$email);
    }

    public function testLanzaExcepcionParaEmailInvalido(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Email('correo-invalido');
    }
}