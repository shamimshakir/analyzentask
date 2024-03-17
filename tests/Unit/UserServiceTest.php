<?php

namespace Tests\Unit;

use App\Contracts\UserServiceInterface;
use App\Models\User;
use App\Services\UserService;
//use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class UserServiceTest extends TestCase
{

    use RefreshDatabase;
    protected UserServiceInterface $userService;

    public function setUp(): void
    {
        parent::setUp();
        $this->userService = new UserService(new User());
    }

    public function test_that_true_is_true(): void
    {
        $this->assertTrue(true);
    }

    public function test_it_can_return_all_users()
    {
        $users = User::all();

        $this->assertCount(3, $users);
    }
}
