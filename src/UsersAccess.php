<?php

namespace Fergusmeldrum\ApiUsersPackage;

use App\Http\Requests\CreateUserRequest;
use Services\ReqresService;
use Illuminate\Http\Client\Response;
use Illuminate\Http\JsonResponse;
use Throwable;

class UsersAccess
{
    public function __construct(
        private ReqresService $reqresService,
    ) {
        $this->$reqresService = new ReqresService();
    } 

    /**
     * Retrieve a single user by ID
     */
    public function getUserById(string $id): JsonResponse
    {
        // url param validation
        if (!is_numeric($id)) {
            return new JsonResponse(['error' => "id parameter must be numeric."], 403);
        }

        try {
            $user = $this->reqresService->getUserById($id);
            return $user;
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
