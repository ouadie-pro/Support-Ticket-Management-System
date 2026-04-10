<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ReponsePredefinieController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return redirect()->route('login');
})->name('home');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');
    
    Route::post('/tickets/{ticket}/comments', [CommentController::class, 'storeTicketComment'])->name('tickets.comments.store');
    Route::post('/complaints/{complaint}/comments', [CommentController::class, 'storeComplaintComment'])->name('complaints.comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    
    Route::post('/tickets/{ticket}/assign', [TicketController::class, 'assign'])->name('tickets.assign');
    Route::post('/tickets/{ticket}/status', [TicketController::class, 'updateStatus'])->name('tickets.update-status');
    
    Route::post('/complaints/{complaint}/assign', [ComplaintController::class, 'assign'])->name('complaints.assign');
    Route::post('/complaints/{complaint}/status', [ComplaintController::class, 'updateStatus'])->name('complaints.update-status');
    Route::post('/complaints/{complaint}/priority', [ComplaintController::class, 'updatePriority'])->name('complaints.update-priority');
    Route::post('/complaints/{complaint}/resolve', [ComplaintController::class, 'resolve'])->name('complaints.resolve');

    Route::post('/notifications/mark-read', function () {
        auth()->user()->unreadNotifications->markAsRead();
        return back();
    })->name('notifications.markRead');
    
    Route::resource('tickets', TicketController::class);
    Route::resource('complaints', ComplaintController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('reponsePredefinies', ReponsePredefinieController::class);
});

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/users/create', [AdminController::class, 'createUser'])->name('users.create');
    Route::post('/users', [AdminController::class, 'storeUser'])->name('users.store');
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');
    Route::get('/reports', [AdminController::class, 'reports'])->name('reports');
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
});

Route::middleware(['auth', 'role:agent'])->prefix('agent')->name('agent.')->group(function () {
    Route::get('/dashboard', function () {
        $user = auth()->user();
        $tickets = \App\Models\Ticket::where('assigne_a', $user->id)->paginate(15);
        $complaints = \App\Models\Complaint::where('traite_par', $user->id)->paginate(15);
        $nouvellesComplaints = \App\Models\Complaint::whereNull('traite_par')
            ->whereIn('statut', ['soumis', 'en_attente'])
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return view('agent.dashboard', compact('tickets', 'complaints', 'nouvellesComplaints'));
    })->name('dashboard');
});
