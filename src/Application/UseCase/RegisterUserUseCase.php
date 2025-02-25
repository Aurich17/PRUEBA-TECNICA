<?php
namespace Application\UseCase;

use Application\DTO\RegisterUserRequest;
use Application\DTO\UserResponseDTO;
use Domain\Entity\User;
use Domain\ValueObject\Email;
use Domain\ValueObject\Name;
use Domain\ValueObject\Password;
use Domain\ValueObject\UserId;
use Infrastructure\Repository\UserRepositoryInterface;
use Domain\Event\UserRegisteredEvent;
use Domain\Shared\Exception\UserAlreadyExistsException;

final class RegisterUserUseCase
{
    private UserRepositoryInterface $userRepository;
    private $eventDispatcher;

    public function __construct(UserRepositoryInterface $userRepository, $eventDispatcher)
    {
        $this->userRepository  = $userRepository;
        $this->eventDispatcher = $eventDispatcher;
    }

    public function execute(RegisterUserRequest $request): UserResponseDTO
    {
        $name     = new Name($request->name);
        $email    = new Email($request->email);
        $password = new Password($request->password);
        $userId   = new UserId();

        $existingUser = $this->userRepository->findById($userId);

        if ($existingUser) {
            throw new UserAlreadyExistsException("El email ya está registrado.");
        }

        $user = new User($userId, $name, $email, $password);

        $this->userRepository->save($user);

        $event = new UserRegisteredEvent($user);
        $this->eventDispatcher->dispatch($event);

        return new UserResponseDTO(
            (string)$user->getId(),
            (string)$user->getName(),
            (string)$user->getEmail(),
            $user->getCreatedAt()->format('Y-m-d H:i:s')
        );
    }
}
