<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RoleBasedAccessTest extends TestCase
{
    use RefreshDatabase;

    public function test_super_admin_can_view_organizations_index(): void
    {
        $user = User::factory()->create([
            'role' => 'super_admin',
        ]);

        $response = $this->actingAs($user)->get('/organizations');

        $response->assertOk();
    }

    public function test_coordinator_cannot_view_organizations_index(): void
    {
        $user = User::factory()->create([
            'role' => 'coordinator',
        ]);

        $response = $this->actingAs($user)->get('/organizations');

        $response->assertForbidden();
    }
}
