<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\AdminController;
use App\Models\Location;

Route::get('/', function (\Illuminate\Http\Request $request) {
    $business = \App\Models\Business::first();
    $location = (object)['location_name' => $business?->location_name];
    $kwd = $request->query('kwd', 'Mobile Tyre Fitting');
    $loc = $request->query('loc');
    if ($loc) {
        $location = Location::where('location_id', $loc)->first(["location_name"]);
        
        if (!$location) {
            $location = (object)['location_name' => 'Manchester'];
        }
    };

    $mobile = $business?->phone_number;

    return view('welcome', compact('kwd', 'loc', 'location', 'mobile', "business"));
});

Route::get('/locations/import', [LocationController::class, 'showImportForm'])->name('locations.import.form');
Route::post('/locations/import', [LocationController::class, 'import'])->name('locations.import');

// Admin login routes
Route::get('/admin/login', function() {
    return view('admin_login');
})->name('admin.login.form');

Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');

Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

// Button management routes (admin)
Route::middleware('admin')->group(function () {
    Route::get('/admin/buttons', [AdminController::class, 'listButtons'])->name('admin.buttons.list');
    Route::post('/admin/buttons', [AdminController::class, 'storeButton'])->name('admin.buttons.store');
    Route::post('/admin/buttons/{button}', [AdminController::class, 'updateButton'])->name('admin.buttons.update');
    Route::delete('/admin/buttons/{button}', [AdminController::class, 'deleteButton'])->name('admin.buttons.delete');
});

// Business management routes (protected)
Route::middleware('admin')->group(function () {
    Route::get('/admin/business/create', [AdminController::class, 'createBusinessForm'])->name('admin.business.create.form');
    Route::post('/admin/business/create', [AdminController::class, 'storeBusiness'])->name('admin.business.create');
});
