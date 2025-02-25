<?php
namespace Infrastructure\Repository;

use Domain\Entity\User;
use Domain\ValueObject\UserId;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;

class DoctrineUserRepository implements UserRepositoryInterface
{
    private EntityManagerInterface $entityManager;
    /** @var EntityRepository<User> */
    private $repository;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        $this->repository = $entityManager->getRepository(User::class);
    }

    public function save(User $user): void
    {
        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }

    public function findById(UserId $id): ?User
    {
        return $this->repository->find((string) $id);
    }

    public function delete(UserId $id): void
    {
        $user = $this->findById($id);
        if ($user !== null) {
            $this->entityManager->remove($user);
            $this->entityManager->flush();
        }
    }
}