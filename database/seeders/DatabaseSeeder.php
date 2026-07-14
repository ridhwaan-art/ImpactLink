<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Certificate;
use App\Models\Event;
use App\Models\Organization;
use App\Models\Project;
use App\Models\User;
use App\Models\Volunteer;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $organization = Organization::create([
            'name' => 'Muslim Youth United (MYU)',
            'email' => 'info@myu.org',
            'phone' => '+265 991 000 000',
            'address' => 'Lilongwe, Malawi',
        ]);

        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@impactlink.test',
            'password' => bcrypt('password'),
            'role' => 'super_admin',
            'organization_id' => $organization->id,
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Organization Admin',
            'email' => 'orgadmin@impactlink.test',
            'password' => bcrypt('password'),
            'role' => 'organization_admin',
            'organization_id' => $organization->id,
            'email_verified_at' => now(),
        ]);

        User::create([
            'name' => 'Coordinator',
            'email' => 'coordinator@impactlink.test',
            'password' => bcrypt('password'),
            'role' => 'coordinator',
            'organization_id' => $organization->id,
            'email_verified_at' => now(),
        ]);

        $project = Project::create([
            'organization_id' => $organization->id,
            'title' => 'MYU Feeding Program',
            'description' => 'Community nutrition outreach and food distribution.',
            'start_date' => now()->subMonths(2)->toDateString(),
            'end_date' => now()->addMonths(4)->toDateString(),
            'status' => 'Active',
        ]);

        $volunteers = Volunteer::factory(50)->create(['organization_id' => $organization->id]);

        $events = [];
        foreach (['Weekly Feeding Session', 'Youth Outreach Day', 'School Visit', 'Community Clean-Up', 'Volunteer Orientation'] as $index => $title) {
            $events[] = Event::create([
                'organization_id' => $organization->id,
                'project_id' => $project->id,
                'title' => $title,
                'description' => 'Demo event for ImpactLink Malawi MVP.',
                'event_date' => now()->addDays($index + 1)->toDateString(),
                'start_time' => '09:00',
                'end_time' => '11:00',
                'location' => 'Lilongwe Community Hall',
                'maximum_volunteers' => $index === 0 ? 20 : 25,
                'qr_token' => Str::uuid(),
                'status' => 'Scheduled',
            ]);
        }

        $event = $events[0];
        $event->volunteers()->attach($volunteers->take(20)->pluck('id'));

        foreach ($volunteers->take(10) as $volunteer) {
            Attendance::create([
                'event_id' => $event->id,
                'volunteer_id' => $volunteer->id,
                'check_in_time' => now(),
                'status' => 'Present',
            ]);
        }

        foreach ($volunteers->take(3) as $volunteer) {
            Certificate::create([
                'certificate_number' => 'IML-'.Str::upper(Str::random(6)),
                'volunteer_id' => $volunteer->id,
                'project_id' => $project->id,
                'issue_date' => now()->toDateString(),
            ]);
        }
    }
}
