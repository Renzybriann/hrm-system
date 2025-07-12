<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\HR\JobController; // Make sure this is imported
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HR\UserController;
use App\Http\Controllers\JobApplicationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [PageController::class, 'dashboard'])->middleware(['auth', 'verified'])->name('dashboard');

// General user pages
Route::middleware('auth')->group(function () {
    Route::get('/job-opportunities', [PageController::class, 'jobOpportunities'])->name('jobs');
    Route::get('/profile/view', [PageController::class, 'viewProfile'])->name('profile.view');
    Route::get('/profile/edit-page', [PageController::class, 'editProfile'])->name('profile.edit-page');
    Route::post('/jobs/{job}/apply', [JobApplicationController::class, 'store'])->name('jobs.apply');
    Route::get('/my-applications', [PageController::class, 'myApplications'])->name('my.applications');
    Route::get('/jobs/{job}', [PageController::class, 'showJob'])->name('jobs.show');
});

// HR-only pages
Route::middleware(['auth', 'role:hr'])->name('hr.')->prefix('hr')->group(function () {
    Route::get('/dashboard', function() {
        return view('hr.dashboard');
    })->name('dashboard');

    // This line defines hr.jobs.index, hr.jobs.create, etc.
    Route::resource('jobs', JobController::class);
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/jobs/{job}/applications', [JobController::class, 'viewApplications'])->name('jobs.applications');
    Route::get('/applicants', [JobController::class, 'applicantsIndex'])->name('applicants.index');
    Route::get('/users/verify', [UserController::class, 'verifyList'])->name('users.verify.list');
    Route::patch('/users/{user}/verify', [UserController::class, 'verifyUser'])->name('users.verify.user');
});


// Default Breeze profile routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';