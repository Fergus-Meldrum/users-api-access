<?php

namespace ApiUsersPackage;

use ApiUsersPackage\Dtos\UserDto;
use ApiUsersPackage\Services\ReqresService;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Throwable;

class UsersAccess
{
    /**
     * Retrieve a single user by ID
     */
    public function getUserById(string $id): UserDto
    {
        // id param validation
        if (!is_numeric($id)) {
            $error = new Exception("id parameter must be numeric.", 403);
            throw($error);
        }

        try {
            $reqresService = new ReqresService();
            return $reqresService->getUserById($id);
        } catch (Throwable $e) {
            $errorMessage = $e->getCode() === 404 ? 'User with id ' . $id . ' not found' : $e->getMessage();
            $error =  new Exception($errorMessage, $e->getCode());
            throw($error);
        }
    }

    /**
     * Retrieve a paginated list of users
     */
    public function getAllUsers(?int $page = null): LengthAwarePaginator
    {
        try {
            $reqresService = new ReqresService();
            return $reqresService->getAllUsers($page);
        } catch (Throwable $e) {
            throw($e);
        }
    }

    // /**
    //  * Create a new user, providing a name and job, and return a User ID.
    //  */
    // public function createUser(string $name, string $job): JsonResponse
    // {
    //     try {
    //         $userId = $this->reqresService->createUser($name, $job);
    //         return new JsonResponse(['user-id' => $userId]);
    //     } catch (Throwable $e) {
    //         return new JsonResponse(['error' => $e->getMessage()], $e->getCode());
    //     }
    // }
}
