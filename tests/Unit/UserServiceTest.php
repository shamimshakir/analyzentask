<?php

namespace Tests\Unit;

use App\Contracts\UserServiceInterface;
use App\Events\UserCreatedOrUpdated;
use App\Models\Address;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserServiceTest extends TestCase
{

    use RefreshDatabase;

    protected UserServiceInterface $service;

    public function setUp(): void
    {
        parent::setUp();
        $this->service = new UserService(new User());
    }

    public function test_it_can_return_all_users()
    {
        User::factory()->count(3)->create();
        $users = $this->service->index();
        $this->assertCount(3, $users);
    }

    public function test_it_can_find_a_user_by_id()
    {
        $user = User::factory()->create();
        $foundUser = $this->service->find($user->id);
        $this->assertEquals($user->id, $foundUser->id);
    }

    public function test_it_can_add_new_user()
    {
        Event::fake();
        $inputArray = User::factory()->make()->toArray();
        $inputArray['password'] = 'password';
        $inputArray['addresses'] = Address::factory()->count(2)->make()->toArray();;

        $user = $this->service->store($inputArray);

        $this->assertInstanceOf(User::class, $user);
        $this->assertTrue(Hash::check('password', $user->password));
        Event::assertDispatched(UserCreatedOrUpdated::class);
    }

    public function test_it_can_update_existing_user()
    {
        $user = User::factory()->create();
        $updatedData = ['first_name' => 'updated'];
        $this->service->update($updatedData, $user->id);

        $this->assertEquals('updated', $user->fresh()->first_name);
    }

    public function test_it_can_soft_delete_user()
    {
        $user = User::factory()->create();
        $this->service->trash($user->id);

        $this->assertSoftDeleted('users', ['id' => $user->id]);
    }

    public function test_it_can_restore_trashed_user()
    {
        $user = User::factory()->create();
        $user->delete();
        $this->service->restore($user->id);

        $this->assertDatabaseHas('users', ['id' => $user->id, 'deleted_at' => null]);
    }

    public function test_it_can_force_delete_trashed_user()
    {
        $user = User::factory()->create();
        $user->delete();
        $this->service->destroy($user->id);

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

}
