<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StylistController;
use App\Http\Controllers\PublicWebsiteController;
use App\Http\Controllers\ReceptionistController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AppointmentController;

// 1. PUBLIC ROUTES
Route::get('/', [PublicWebsiteController::class, 'index'])->name('home');

// 2. AUTHENTICATION ROUTES
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// 3. ADMIN PROTECTED ROUTES
Route::middleware(['auth', 'admin'])->group(function () {
    // Admin Views
    Route::get('/admin-dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/admin-analytics', [AdminController::class, 'analytics'])->name('admin.analytics');
    Route::get('/admin-posCheckout', [AdminController::class, 'pos_checkout'])->name('admin.posCheckout');
    Route::get('/admin-schedular', [AdminController::class, 'schedular'])->name('admin.scheduler');
    Route::get('/admin-staff', [AdminController::class, 'staff'])->name('admin.staff');
    Route::get('/admin-services', [AdminController::class, 'services'])->name('admin.services');

    // CRUD Routes for Inventory
    Route::get('/admin-inventory', [InventoryController::class, 'showProducts'])->name('fetch.inventory');
    Route::post('/admin-inventory', [InventoryController::class, 'insert'])->name('insert.inventory');
    Route::post('/inventory/{id}', [InventoryController::class, 'update']);

    // CRUD Routes for Clients
    Route::get('/admin-clients', [ClientController::class, 'index'])->name('admin.clients');
    Route::post('/admin-clients', [ClientController::class, 'store'])->name('admin.clients.store');
    Route::put('/admin-clients/{client}', [ClientController::class, 'update'])->name('admin.clients.update');
    Route::delete('/admin-clients/{client}', [ClientController::class, 'destroy'])->name('admin.clients.destroy');

    // CRUD Routes for Services
    Route::post('/admin-services', [ServiceController::class, 'insert'])->name('insert.service');

    // CRUD Routes for Orders
    Route::post('/admin-posCheckout', [OrderController::class, 'insert'])->name('insert.order');

    // Staff Management Routes
    Route::post('/staff/store', [StaffController::class, 'store'])->name('staff.store');
    Route::post('/staff/update/{id}', [StaffController::class, 'update'])->name('staff.edit');
    Route::delete('/staff/{id}', [StaffController::class, 'destroy'])->name('staff.destroy');

    // routes for appointment
 Route::post('/appointments/store',[AppointmentController::class,'store'])->name('appointments.store');
 Route::get('/appointments/list', [AppointmentController::class, 'index']) ->name('appointments.index');
 Route::post('/appointments/update/{id}', [AppointmentController::class,'update']) ->name('appointments.update');
Route::delete('/appointments/delete/{id}', [AppointmentController::class, 'destroy'])->name('appointments.destroy');
});


// 4. RECEPTIONIST PROTECTED ROUTES
Route::middleware(['auth', 'receptionist'])->group(function () {
    Route::get('/rec-dashboard', [ReceptionistController::class, 'dashboard'])->name('receptionist.dashboard');
    Route::get('/rec-clients', [ReceptionistController::class, 'clients'])->name('receptionist.clients');
    Route::get('/rec-posCheckout', [ReceptionistController::class, 'pos_checkout'])->name('receptionist.posCheckout');
    Route::get('/rec-schedular', [ReceptionistController::class, 'schedular'])->name('receptionist.scheduler');
});


// 5. STYLIST PROTECTED ROUTES
Route::middleware(['auth', 'stylist'])->group(function () {
    Route::get('/stylist-dashboard', [StylistController::class, 'mywork'])->name('stylist.dashboard');
});