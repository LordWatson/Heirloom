<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UserCanBeAssignedRoleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_be_assigned_role()
    {
        // Create a User
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        // Create Role
        $role = Role::create([
            'name' => 'user'
        ]);

        // Assign Role to User
        $user->assignRole($role->name);

        // Assert: Has the role been assigned to the user?
        if($user->hasRole($role->name))
        {
            $this->assertTrue(true);
        }else
        {
            $this->fail('User was not assigned to role');
        }
    }
}
