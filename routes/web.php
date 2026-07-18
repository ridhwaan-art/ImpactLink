<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\VolunteerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::get('/organizations', [OrganizationController::class, 'index'])->name('organizations.index')->middleware('role:super_admin');
    Route::get('/organizations/create', [OrganizationController::class, 'create'])->name('organizations.create')->middleware('role:super_admin');
    Route::post('/organizations', [OrganizationController::class, 'store'])->name('organizations.store')->middleware('role:super_admin');
    Route::get('/organizations/{organization}', [OrganizationController::class, 'show'])->name('organizations.show')->middleware('role:super_admin');
    Route::get('/organizations/{organization}/edit', [OrganizationController::class, 'edit'])->name('organizations.edit')->middleware('role:super_admin');
    Route::put('/organizations/{organization}', [OrganizationController::class, 'update'])->name('organizations.update')->middleware('role:super_admin');
    Route::delete('/organizations/{organization}', [OrganizationController::class, 'destroy'])->name('organizations.destroy')->middleware('role:super_admin');

    Route::resource('volunteers', VolunteerController::class);
    Route::resource('projects', ProjectController::class);
    Route::resource('events', EventController::class);
    Route::get('/events/{event}/assign', [EventController::class, 'assignVolunteers'])->name('events.assign');
    Route::post('/events/{event}/assign', [EventController::class, 'attachVolunteers'])->name('events.attach');

    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');
    Route::get('/scan/{token}', [AttendanceController::class, 'scan'])->name('attendance.scan');

    Route::get('/certificates', [CertificateController::class, 'index'])->name('certificates.index');
    Route::get('/certificates/create', [CertificateController::class, 'create'])->name('certificates.create');
    Route::post('/certificates', [CertificateController::class, 'store'])->name('certificates.store');
    Route::get('/certificates/{certificate}', [CertificateController::class, 'show'])->name('certificates.show');
    Route::get('/certificates/{certificate}/download', [CertificateController::class, 'download'])->name('certificates.download');
    Route::post('/certificates/{certificate}/regenerate', [CertificateController::class, 'regenerate'])->name('certificates.regenerate');
    Route::get('/certificates/verify/{token}', [CertificateController::class, 'verify'])->name('certificates.verify');
    Route::post('/volunteers/{volunteer}/certificates', [CertificateController::class, 'generateForVolunteer'])->name('volunteers.certificates.store');
    Route::post('/events/{event}/certificates/generate', [CertificateController::class, 'generateForEvent'])->name('events.certificates.generate');

    Route::get('/search', SearchController::class)->name('search');
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
