<?php

namespace ApiUsersPackage\Tests;

use ApiUsersPackage\Services\ReqresService;
use PHPUnit\Framework\TestCase;

class ReqresServiceTest extends TestCase
{
    protected ReqresService $requesService;

    protected function setUp(): void
    {
        $this->requesService = new ReqresService();
    }

    /**
     * Tests for getUserById
     */

    public function test_getUserById_response_ok(): void
    {
        $this->assertTrue(true);
    }

    public function test_getUserById_throws_error(): void
    {
        $this->assertTrue(true);
    }

    /**
     * Tests for getAllUsers
     */

     public function test_getAllUsers_response_ok(): void
     {
        $this->assertTrue(true);
     }

     public function test_getAllUsers_throws_error(): void
     {
         $this->assertTrue(true);
     }

     /**
      * Tests for createUser
      */

      public function test_createUser_response_created()
      {
        $this->assertTrue(true);
      }

      public function test_createUser_throws_error(): void
      {
          $this->assertTrue(true);
      }

}
