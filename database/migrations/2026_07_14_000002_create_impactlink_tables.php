<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('logo')->nullable();
            $table->timestamps();
        });

        Schema::create('volunteers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->constrained()->cascadeOnDelete();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('gender');
            $table->string('age_range');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('location')->nullable();
            $table->string('volunteer_type');
            $table->string('institution_name')->nullable();
            $table->string('status')->default('Active');
            $table->string('qr_code')->nullable();
            $table->timestamps();
        });

        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->string('status')->default('Planning');
            $table->timestamps();
        });

        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('organization_id')->constrained()->cascadeOnDelete();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('event_date');
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->string('location')->nullable();
            $table->integer('maximum_volunteers')->default(20);
            $table->string('qr_token')->nullable();
            $table->string('status')->default('Scheduled');
            $table->timestamps();
        });

        Schema::create('volunteer_event', function (Blueprint $table) {
            $table->id();
            $table->foreignId('volunteer_id')->constrained()->cascadeOnDelete();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('event_id')->constrained()->cascadeOnDelete();
            $table->foreignId('volunteer_id')->constrained()->cascadeOnDelete();
            $table->timestamp('check_in_time')->nullable();
            $table->string('status')->default('Absent');
            $table->timestamps();
        });

        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('certificate_number')->unique();
            $table->foreignId('volunteer_id')->constrained()->cascadeOnDelete();
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->date('issue_date');
            $table->string('pdf_path')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('certificates');
        Schema::dropIfExists('attendances');
        Schema::dropIfExists('volunteer_event');
        Schema::dropIfExists('events');
        Schema::dropIfExists('projects');
        Schema::dropIfExists('volunteers');
        Schema::dropIfExists('organizations');
    }
};
