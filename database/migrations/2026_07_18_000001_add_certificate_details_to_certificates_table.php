<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('certificates', function (Blueprint $table) {
            $table->foreignId('event_id')->nullable()->after('project_id')->constrained()->nullOnDelete();
            $table->integer('hours')->nullable()->after('event_id');
            $table->foreignId('generated_by')->nullable()->after('hours')->constrained('users')->nullOnDelete();
            $table->string('status')->default('Issued')->after('generated_by');
            $table->string('verification_token')->nullable()->unique()->after('status');
            $table->text('description')->nullable()->after('verification_token');
        });
    }

    public function down(): void
    {
        Schema::table('certificates', function (Blueprint $table) {
            $table->dropConstrainedForeignId('event_id');
            $table->dropConstrainedForeignId('generated_by');
            $table->dropColumn(['hours', 'status', 'verification_token', 'description']);
        });
    }
};
