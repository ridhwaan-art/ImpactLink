<?php

use App\Models\Certificate;
use App\Models\Organization;
use App\Models\Project;
use App\Models\User;
use App\Models\Volunteer;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CertificateGenerationTest extends TestCase
{
    public function test_certificate_generation_saves_pdf_and_redirects(): void
    {
        $organization = Organization::create([
            'name' => 'ImpactLink Malawi',
            'email' => 'info@example.com',
        ]);

        $project = Project::create([
            'organization_id' => $organization->id,
            'title' => 'Community Outreach',
            'description' => 'Volunteer outreach',
            'start_date' => now()->toDateString(),
            'end_date' => now()->addMonth()->toDateString(),
            'status' => 'Active',
        ]);

        $volunteer = Volunteer::create([
            'organization_id' => $organization->id,
            'first_name' => 'Jane',
            'last_name' => 'Mwale',
            'gender' => 'Female',
            'age_range' => '18-24',
            'phone' => '0999999999',
            'email' => 'jane@example.com',
            'location' => 'Lilongwe',
            'volunteer_type' => 'Community',
            'institution_name' => 'University',
            'status' => 'Active',
            'qr_code' => 'volunteer-1',
        ]);

        $user = User::factory()->create([
            'organization_id' => $organization->id,
            'role' => 'coordinator',
        ]);

        $response = $this->actingAs($user)->post(route('certificates.store'), [
            'volunteer_id' => $volunteer->id,
            'project_id' => $project->id,
            'hours' => 6,
        ]);

        $response->assertRedirect(route('certificates.index'));
        $response->assertSessionHas('success', 'Certificate generated successfully.');

        $certificate = Certificate::where('volunteer_id', $volunteer->id)->first();

        $this->assertNotNull($certificate);
        $this->assertNotEmpty($certificate->pdf_path);
        $this->assertTrue(Storage::disk('public')->exists($certificate->pdf_path));
    }
}
