<?php

namespace Tests\Feature\Permissions;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Tests\TestCase;

class CreatePermissionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function permission_can_be_created()
    {
        // Create Permission
        $permission = Permission::create([
            'name' => 'access admin dashboard'
        ]);

        // Assert: Does the permission exist in the DB?
        $this->assertModelExists($permission);
    }
}
