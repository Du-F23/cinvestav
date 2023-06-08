<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    if(auth()->check()) {
        return redirect()->route('dashboard');
    }
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/profile/changePicture', [ProfileController::class, 'changePicture'])->name('profile.changePicture');
    Route::resource('users', UsersController::class);
    Route::put('/users/{user}/restore', [UsersController::class, 'restore'])->name('users.restore');
    Route::delete('/users/{user}/forceDelete', [UsersController::class, 'forceDelete'])->name('users.forceDelete');

    Route::resource('proposals', ProposalController::class);
    Route::put('/proposals/{proposal}/restore', [ProposalController::class, 'restore'])->name('proposals.restore');
    Route::delete('/proposals/{proposal}/forceDelete', [ProposalController::class, 'forceDelete'])->name('proposals.forceDelete');

    Route::resource('evaluate-proposals', EvaluateProposal::class);
    Route::put('/evaluate-proposals/{evaluateProposal}/restore', [EvaluateProposal::class, 'restore'])->name('evaluate-proposals.restore');
    Route::delete('/evaluate-proposals/{evaluateProposal}/forceDelete', [EvaluateProposal::class, 'forceDelete'])->name('evaluate-proposals.forceDelete');

    Route::resource('ramas', RamaController::class);
    Route::put('/ramas/{rama}/restore', [RamaController::class, 'restore'])->name('ramas.restore');
    Route::delete('/ramas/{rama}/forceDelete', [RamaController::class, 'forceDelete'])->name('ramas.forceDelete');

    Route::resource('project', ProjectController::class);
    Route::put('/project/{project}/restore', [ProjectController::class, 'restore'])->name('project.restore');
    Route::delete('/project/{project}/forceDelete', [ProjectController::class, 'forceDelete'])->name('project.forceDelete');

    Route::resource('messages', MessagesController::class);
    Route::put('/messages/{message}/restore', [MessagesController::class, 'restore'])->name('messages.restore');
    Route::delete('/messages/{message}/forceDelete', [MessagesController::class, 'forceDelete'])->name('messages.forceDelete');
});

require __DIR__.'/auth.php';
