<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocationController;
use App\Models\Location;

Route::get('/', function (\Illuminate\Http\Request $request) {
    $location = (object)['location_name' => 'Manchester'];
    $kwd = $request->query('kwd', 'Mobile Tyre Fitting');
    $loc = $request->query('loc');
    if ($loc) {
        $location = Location::where('location_id', $loc)->first(["location_name"]);
        
        if (!$location) {
            $location = (object)['location_name' => 'Manchester'];
        }
    };

    $mobile = "0752 389 0308";

    return view('welcome', compact('kwd', 'loc', 'location', 'mobile'));
});

Route::get('/locations/import', [LocationController::class, 'showImportForm'])->name('locations.import.form');
Route::post('/locations/import', [LocationController::class, 'import'])->name('locations.import');
