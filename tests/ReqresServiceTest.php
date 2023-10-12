<?php

namespace ApiUsersPackage\Tests;

use ApiUsersPackage\Dtos\UserDto;
use ApiUsersPackage\Services\ReqresService;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Http\Client\RequestException as ClientRequestException;
use Illuminate\Http\Client\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Http;
use PHPUnit\Framework\TestCase;
use Mockery;

class ReqresServiceTest extends TestCase
{
    protected ReqresService $requesService;

    // protected function setUp(): void
    // {
    //     parent::setUp();

    //     $this->requesService = new ReqresService();
    // }

    // public function test_getUserById_response_ok(): void {
    //     // Create a mock of PendingRequest
    //     $http = Mockery::mock(PendingRequest::class);

    //     // Mock the HTTP client instance
    //     Http::shouldReceive('get')->andReturn($http);

    //     // Create a fake response data for testing
    //     $fakeUserData = [
    //         'id' => 1,
    //         'email' => 'test@example.com',
    //         'first_name' => 'John',
    //         'last_name' => 'Doe',
    //         'avatar' => 'example-avatar.jpg',
    //     ];

    //     // Set up the response for the HTTP client mock
    //     $http->shouldReceive('timeout')->with(3);
    //     $http->shouldReceive('retry')->with(3, 100, \Mockery::type('callable'))->once();
    //     $http->shouldReceive('get')->with(ReqresService::BASE_URL_USERS . '3', null)->andReturn(new Response(json_encode(['data' => $fakeUserData]), 200));

    //     // Create an instance of ReqresService
    //     $yourService = new ReqresService();

    //     // Call the getUserById method
    //     $user = $yourService->getUserById(3);

    //     // Assertions
    //     $this->assertInstanceOf(UserDto::class, $user);
    // }

    // /**
    //  * Tests for getUserById
    //  */

    // public function test_getUserById_response_ok(): void
    // {
    //     $userEmma = [
    //         "id" => 3,
    //         "email" => "emma.wong@reqres.in",
    //         "first_name" => "Emma",
    //         "last_name" => "Wong",
    //         "avatar" => "https://reqres.in/img/faces/3-image.jpg"
    //     ];

    //     // Define the fake response
    //     Http::fake([
    //         ReqresService::BASE_URL_USERS . '3' => Http::response([
    //             "data" => $userEmma,
    //         ], 200),
    //     ]);

    //     $actualUserDto = $this->requesService->getUserById('3');

    //     $expectedUserDto = new UserDto(
    //         id: $userEmma['id'],
    //         email: $userEmma['email'],
    //         firstName: $userEmma['first_name'],
    //         lastName: $userEmma['last_name'],
    //         avatar: $userEmma['avatar']
    //     );

    //     $this->assertEquals($expectedUserDto, $actualUserDto);
    // }

    // public function test_getUserById_throws_error(): void
    // {
    //     // Define the fake response
    //     Http::fake([
    //         ReqresService::BASE_URL_USERS . '3' => Http::response(
    //             status: 404
    //         ),
    //     ]);

    //     $this->expectException(ClientRequestException::class);

    //     $this->requesService->getUserById('3');
    // }

    // /**
    //  * Tests for getAllUsers
    //  */

    //  public function test_getAllUsers_response_ok(): void
    //  {
    //     $pageNumber = 1;
    //     $resultsPerPage = 2;
    //     $totalResults = 4;
    //     $totalPages = 2;

    //     $userGeorge = [
    //         "id" => 1,
    //         "email" => "george.bluth@reqres.in",
    //         "first_name" => "George",
    //         "last_name" => "Bluth",
    //         "avatar" => "https://reqres.in/img/faces/1-image.jpg"
    //     ];

    //     $userJanet = [
    //         "id" => 2,
    //         "email" => "janet.weaver@reqres.in",
    //         "first_name" => "Janet",
    //         "last_name" => "Weaver",
    //         "avatar" => "https://reqres.in/img/faces/2-image.jpg"
    //     ];

    //     $userData = [
    //         $userGeorge,
    //         $userJanet,
    //     ];

    //     // Define the fake response
    //     Http::fake([
    //         ReqresService::BASE_URL_USERS => Http::response([
    //             "page" => $pageNumber,
    //             "per_page" => $resultsPerPage,
    //             "total" => $totalResults,
    //             "total_pages" => $totalPages,
    //             "data" => $userData,
    //         ], 200),
    //     ]);

    //     $actualPaginator = $this->requesService->getAllUsers();

    //     $expectedUserDtos = collect($userData)->map(function (array $user) {
    //         return new UserDto(
    //             id: $user['id'],
    //             email: $user['email'],
    //             firstName: $user['first_name'],
    //             lastName: $user['last_name'],
    //             avatar: $user['avatar']
    //         );
    //     });

    //     $expectedPaginator = new LengthAwarePaginator(
    //         $expectedUserDtos,
    //         $totalResults,
    //         $resultsPerPage,
    //         $pageNumber,
    //         ['path' => ReqresService::BASE_URL_USERS],
    //     );

    //     $this->assertEquals($expectedPaginator, $actualPaginator);
    //  }

    //  public function test_getAllUsers_throws_error(): void
    //  {
    //      // Define the fake response
    //      Http::fake([
    //         ReqresService::BASE_URL_USERS => Http::response(
    //              status: 500
    //          ),
    //      ]);
 
    //      $this->expectException(ClientRequestException::class);
 
    //      $this->requesService->getAllUsers();
    //  }

    //  /**
    //   * Tests for createUser
    //   */

    //   public function test_createUser_response_created()
    //   {
    //     $name = 'lando';
    //     $job = 'cleaner';

    //     // Define the fake response
    //     Http::fake([
    //         ReqresService::BASE_URL_USERS => Http::response([
    //             "name" => $name,
    //             "job" => $job,
    //             "id" => "77",
    //         ], 201),
    //     ]);

    //     $actualUserId = $this->requesService->createUser($name, $job);

    //     $expectedUserId = 77;

    //     $this->assertEquals($expectedUserId, $actualUserId);
    //   }

    //   public function test_createUser_throws_error(): void
    //   {
    //       // Define the fake response
    //       Http::fake([
    //          ReqresService::BASE_URL_USERS => Http::response(
    //               status: 408
    //           ),
    //       ]);
  
    //       $this->expectException(ClientRequestException::class);
  
    //       $this->requesService->createUser('chuck', 'caretaker');
    //   }

}
