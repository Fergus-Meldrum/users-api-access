<?php

namespace ApiUsersPackage\Services;

use ApiUsersPackage\Dtos\UserDto;
use Exception;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class ReqresService
{

    public const BASE_URL_USERS = 'https://reqres.in/api/users/';

    public function makeGetRequest(string $url, array $params = null)
    {
        return Http::timeout(3)->retry(3, 100, function (Exception $exception) {
            return ($exception->getCode() === 500);
        })->get($url, $params);
    }

    public function makePostRequest(string $url, array $params = null)
    {
        $client = new PendingRequest();

        // Set a timeout for the request (if needed)
        $client->timeout(3);

        $client->retry(3, 100, function (Exception $exception) {
            return $exception->getCode() === 500;
        });

        // Perform the POST request
        try {
            $response = $client->post($url, $params);

            return $response;
        } catch (Exception $exception) {
            throw $exception;
        }
    }

    public function getUserById(string $id): UserDto
    {
        $response = $this->makeGetRequest(self::BASE_URL_USERS . $id);

        // Throw an exception unless the response has status code 200
        $response->throwUnlessStatus(200);

        $userData = $response['data'];

        return new UserDto(
            id: $userData['id'],
            email: $userData['email'],
            firstName: $userData['first_name'],
            lastName: $userData['last_name'],
            avatar: $userData['avatar']
        );
    }

    public function getAllUsers(?int $page = null): LengthAwarePaginator
    {
        $response = $this->makeGetRequest(self::BASE_URL_USERS, [
            'page' => $page,
        ]);

        // Throw an exception unless the response has status code 200
        $response->throwUnlessStatus(200);

        // did not see the point in creating User Modal class when we dont have a DB
        $data = array_map(function (array $user) {
            return new UserDto(
                id: $user['id'],
                email: $user['email'],
                firstName: $user['first_name'],
                lastName: $user['last_name'],
                avatar: $user['avatar']
            );
        }, $response['data']);

        return new LengthAwarePaginator(
            $data,
            $response['total'],
            $response['per_page'],
            $response['page'],
            ['path' => self::BASE_URL_USERS],
        );
    }

    public function createUser(string $name, string $job): int
    {
        $response = $this->makePostRequest(self::BASE_URL_USERS, [
            'name' => $name,
            'job'  => $job,
        ]);

        // Throw an exception unless the response has status code 201
        $response->throwUnlessStatus(201);

        return (int) $response['id'];
    }
}
