<?php
namespace Domain\ValueObject;

use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class UserId
{
    private UuidInterface $uuid;

    public function __construct(?string $uuid = null)
    {
        $this->uuid = $uuid ? Uuid::fromString($uuid) : Uuid::uuid4();
    }

    public function __toString(): string
    {
        return $this->uuid->toString();
    }

    public function equals(UserId $other): bool
    {
        return $this->uuid->equals($other->uuid);
    }
}