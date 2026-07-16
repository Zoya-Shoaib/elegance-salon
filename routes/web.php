<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StylistController;
use App\Http\Controllers\PublicWebsiteController;
use App\Http\Controllers\ReceptionistController;
use App\Http\Controllers\AuthController;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

// routes for public website view
Route::get('/', [PublicWebsiteController::class, 'index'])->name('home');

// routes for admin views
Route::get('/admin-dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin-analytics', [AdminController::class, 'analytics'])->name('admin.analytics');
Route::get('/admin-clients', [AdminController::class, 'clients'])->name('admin.clients');
Route::get('/admin-inventory', [AdminController::class, 'inventory'])->name('admin.inventory');
Route::get('/admin-posCheckout', [AdminController::class, 'pos_checkout'])->name('admin.posCheckout');
Route::get('/admin-schedular', [AdminController::class, 'schedular'])->name('admin.scheduler');
Route::get('/admin-staff', [AdminController::class, 'staff'])->name('admin.staff');

// routes for receptionist views
Route::get('/rec-dashboard', [ReceptionistController::class, 'dashboard'])->name('receptionist.dashboard');
Route::get('/rec-clients', [ReceptionistController::class, 'clients'])->name('receptionist.clients');
Route::get('/rec-posCheckout', [ReceptionistController::class, 'pos_checkout'])->name('receptionist.posCheckout');
Route::get('/rec-schedular', [ReceptionistController::class, 'schedular'])->name('receptionist.scheduler');

// routes for stylist views
Route::get('/stylist-dashboard', [StylistController::class, 'mywork'])->name('stylist.dashboard');

// routes for authentication
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
