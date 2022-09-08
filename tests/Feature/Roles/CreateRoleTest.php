<?php

namespace Tests\Feature\Roles;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class CreateRoleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function role_can_be_created()
    {
        // Create Role
        $role = Role::create([
            'name' => 'admin'
        ]);

        // Assert: Does the role exist in the DB?
        $this->assertModelExists($role);
    }
}
