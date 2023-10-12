<?php

namespace ApiUsersPackage;

use ApiUsersPackage\Dtos\UserDto;
use ApiUsersPackage\Services\ReqresService;
use Illuminate\Http\JsonResponse;
use Throwable;

class UsersAccess
{
    /**
     * Retrieve a single user by ID
     */
    public function getUserById(string $id): JsonResponse|UserDto
    {
        // url param validation
        if (!is_numeric($id)) {
            return new JsonResponse(['error' => "id parameter must be numeric."], 403);
        }

        try {
            $reqresService = new ReqresService();
            return $reqresService->getUserById($id);
        } catch (Throwable $e) {
            $errorMessage = $e->getCode() === 404 ? 'User with id ' . $id . ' not found' : $e->getMessage();
            return new JsonResponse(['error' => $errorMessage], $e->getCode());
        }
    }

    // /**
    //  * Retrieve a paginated list of users
    //  */
    // public function getAllUsers(?int $page = null): JsonResponse
    // {
    //     $response = new Response('');

    //     try {
    //         $paginatedUsers = $this->reqresService->getAllUsers($page);
    //         return $response->json($paginatedUsers);
    //     } catch (Throwable $e) {
    //         return new JsonResponse(['error' => $e->getMessage()], $e->getCode());
    //     }
    // }

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
