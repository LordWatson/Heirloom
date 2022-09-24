<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UserRoleTest extends TestCase
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

    /** @test */
    public function admin_user_can_access_admin()
    {
        // Create User
        $user = User::factory()->create();

        // Create Role
        $role = Role::create([
            'name' => 'admin'
        ]);

        // Assign Role to User
        $user->assignRole($role->name);

        // Log user into admin dashboard
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        // Emulate User and GET request to /admin
        $response = $this->actingAs($user)->get('/admin');

        $response->assertStatus(200);
    }

    /** @test */
    public function standard_user_cannot_access_admin()
    {
        // Create User
        $user = User::factory()->create();

        // Create Role
        $role = Role::create([
            'name' => 'user'
        ]);

        // Assign Role to User
        $user->assignRole($role->name);

        // Log user into admin dashboard
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        // Emulate User and GET request to /admin
        $response = $this->actingAs($user)->get('/admin');

        $response->assertRedirect('/dashboard');
    }
}
