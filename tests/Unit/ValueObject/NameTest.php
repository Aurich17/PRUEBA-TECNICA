<?php
namespace Tests\Unit\ValueObject;

use PHPUnit\Framework\TestCase;
use Domain\ValueObject\Name;
use InvalidArgumentException;

final class NameTest extends TestCase
{
    public function testCreaNombreValido(): void
    {
        $name = new Name('Juan Pérez');
        $this->assertEquals('Juan Pérez', (string)$name);
    }

    public function testLanzaExcepcionPorNombreCorto(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Name('A'); 
    }

    public function testLanzaExcepcionPorCaracteresNoPermitidos(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Name('Juan123');
    }
}