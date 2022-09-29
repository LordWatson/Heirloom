<?php

namespace Tests\Feature\Auth;

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Database\Factories\UserFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class UserModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function admin_user_can_update_a_users_details()
    {
        // Create Admin User
        $adminUser = User::factory()->create();

        // Create Role
        $adminRole = Role::create([
            'name' => 'admin'
        ]);

        // Assign Role to Admin User
        $adminUser->assignRole($adminRole->name);

        // Log user into admin dashboard
        $response = $this->post('/login', [
            'email' => $adminUser->email,
            'password' => 'password',
        ]);

        // Create a User
        $standardUser = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        // Create Role
        $standardRole = Role::create([
            'name' => 'user'
        ]);

        // Assign Role to Standard User
        $standardUser->assignRole($standardRole->name);

        // Log admin user into admin dashboard
        $response = $this->post('/login', [
            'email' => $adminUser->email,
            'password' => 'password',
        ]);

        // Emulate User and GET request to /admin
        $response = $this->actingAs($adminUser)->put('/user/' . $standardUser->id, [
            'name' => 'Testing User',
            'email' => 'testing@example.com',
        ]);

        $response->assertRedirect('/user');
    }

    /** @test */
    public function admin_user_can_update_a_users_name_and_keep_existing_email_address()
    {
        // Create Admin User
        $adminUser = User::factory()->create();

        // Create Role
        $adminRole = Role::create([
            'name' => 'admin'
        ]);

        // Assign Role to Admin User
        $adminUser->assignRole($adminRole->name);

        // Log user into admin dashboard
        $response = $this->post('/login', [
            'email' => $adminUser->email,
            'password' => 'password',
        ]);

        // Create a User
        $standardUser = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        // Create Role
        $standardRole = Role::create([
            'name' => 'user'
        ]);

        // Assign Role to Standard User
        $standardUser->assignRole($standardRole->name);

        // Log admin user into admin dashboard
        $response = $this->post('/login', [
            'email' => $adminUser->email,
            'password' => 'password',
        ]);

        // Emulate User and GET request to /admin
        $response = $this->actingAs($adminUser)->put('/user/' . $standardUser->id, [
            'name' => 'Testing User',
            'email' => 'test@example.com',
        ]);

        $response->assertRedirect('/user');
    }
}
