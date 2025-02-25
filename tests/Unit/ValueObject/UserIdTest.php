<?php
namespace Tests\Unit\ValueObject;

use PHPUnit\Framework\TestCase;
use Domain\ValueObject\UserId;

final class UserIdTest extends TestCase
{
    public function testGeneraUnUuidValido(): void
    {
        $userId = new UserId();
        $this->assertMatchesRegularExpression(
            '/^[0-9a-fA-F\-]{36}$/',
            (string)$userId,
            "El UserId no tiene un formato UUID válido."
        );
    }

    public function testIgualdadEntreUserIds(): void
    {
        $uuid = (string)new UserId();
        $userId1 = new UserId($uuid);
        $userId2 = new UserId($uuid);

        $this->assertTrue($userId1->equals($userId2));
    }
}
