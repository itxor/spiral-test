<?php

declare(strict_types=1);

namespace App\Controller;

use App\Request\CreateUserRequest;
use App\Request\EditUserRequest;
use Exception;
use Psr\Http\Message\ResponseInterface;
use RuntimeException;
use Spiral\Core\Container\SingletonInterface;
use Spiral\Prototype\Traits\PrototypeTrait;
use Spiral\Router\Annotation\Route;
use Throwable;

class UserController implements SingletonInterface
{
    use PrototypeTrait;

    /**
     * @Route(route="/user/add", name="user.add", methods="POST")
     *
     * @param CreateUserRequest $request
     *
     * @return ResponseInterface
     *
     * @throws Exception
     * @throws Throwable
     */
    public function create(CreateUserRequest $request): ResponseInterface
    {
        if (!$request->isValid()) {
            throw new Exception(implode(', ', $request->getErrors()));
        }

        $user = $this->userService->createUser(
            $request->getField('username')
        );

        return $this->response->json(
            [
                'data' => [
                    'status' => 'success',
                    'id' => $user->getId()
                ]
            ],
            200
        );
    }

    /**
     * @Route(route="/user/edit", name="user.edit", methods="POST")
     *
     * @param CreateUserRequest $request
     * @param int $id
     *
     * @return ResponseInterface
     *
     * @throws Throwable
     */
    public function edit(EditUserRequest $request): ResponseInterface
    {
        if (!$request->isValid()) {
            throw new RuntimeException(implode(', ', $request->getErrors()));
        }

        $user = $this->userService->editUser(
            $request->getField('id'),
            $request->getField('username')
        );

        return $this->response->json(
            [
                'data' => [
                    'status' => 'success',
                    'id' => $user->getId()
                ]
            ],
            200
        );
    }

    /**
     * @Route(route="/user/delete/<id:\d+>", name="user.delete", methods="GET")
     *
     * @param int $id
     *
     * @return ResponseInterface
     *
     * @throws Throwable
     */
    public function delete(int $id): ResponseInterface
    {
        $this->userService->deleteUser($id);

        return $this->response->json(
            [
                'data' => [
                    'status' => 'success',
                ]
            ]
        );
    }

    /**
     * @Route(route="/user/<id:\d+>", name="user.get", methods="GET")
     *
     * @param int $id
     *
     * @return ResponseInterface
     */
    public function get(int $id): ResponseInterface
    {
        $user = $this->userService->getUser($id);

        return $this->response->json(
            [
                'data' => [
                    'status' => 'success',
                    'id' => $user->getId(),
                    'name' => $user->getName(),
                ]
            ],
            200
        );
    }

    /**
     * @Route(route="/user/list", name="user.list", methods="GET")
     *
     * @return ResponseInterface
     */
    public function list(): ResponseInterface
    {
        $users = $this->userService->getUsers();

        return $this->response->json(
            [
                'data' => [
                    'status' => 'success',
                    'users' => $users
                ]
            ],
            200
        );
    }
}
