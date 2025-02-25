<?php
namespace Infrastructure\EventHandler;

use Domain\Event\UserRegisteredEvent;

final class UserRegisteredEventHandler
{

    public function handle(UserRegisteredEvent $event): void
    {
        $user = $event->getUser();
        echo sprintf(
            (string)$user->getName(),
            (string)$user->getEmail()
        );
    }
}