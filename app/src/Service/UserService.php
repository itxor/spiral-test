<?php

namespace App\Service;

use App\Database\User;
use App\Repository\UserRepository;
use Cycle\ORM\TransactionInterface;
use Spiral\Http\Exception\ClientException\NotFoundException;
use Spiral\Prototype\Annotation\Prototyped;
use Throwable;

/**
 * @Prototyped(property="userService")
 */
class UserService
{
    /**
     * @var TransactionInterface
     */
    private $tr;

    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * @param TransactionInterface $tr
     * @param UserRepository $repository
     */
    public function __construct(
        TransactionInterface $tr,
        UserRepository $repository
    )
    {
        $this->tr = $tr;
        $this->repository = $repository;
    }

    /**
     * @param string $username
     *
     * @return User
     *
     * @throws Throwable
     */
    public function createUser(string $username): User
    {
        $user = new User();
        $user->setName($username);
        $this->tr->persist($user);
        $this->tr->run();

        return $user;
    }

    /**
     * @param int $id
     *
     * @return void
     *
     * @throws Throwable
     */
    public function deleteUser(int $id): void
    {
        $user = $this->repository->findByPK($id);
        if (is_null($user)) {
            throw new NotFoundException();
        }

        $this->tr->delete($user);
        $this->tr->run();
    }

    /**
     * @param int $id
     * @param string $username
     *
     * @return User
     *
     * @throws Throwable
     */
    public function editUser(int $id, string $username): User
    {
        /** @var User $user */
        $user = $this->repository->findByPK($id);
        if (is_null($user)) {
            throw new NotFoundException();
        }

        $user->setName($username);
        $this->tr->persist($user);
        $this->tr->run();

        return $user;
    }

    /**
     * @param int $id
     *
     * @return User
     */
    public function getUser(int $id): User
    {
        /** @var User $user */
        $user = $this->repository->findByPK($id);
        if (is_null($user)) {
            throw new NotFoundException();
        }

        return $user;
    }

    /**
     * @return array
     */
    public function getUsers(): array
    {
        $users = $this->repository->findAll();
        $users = array_map(
            function ($user) {
                /** @var User $user */
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                ];
            },
            (array)$users
        );

        return $users;
    }
}