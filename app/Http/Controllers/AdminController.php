<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Business;

class AdminController extends Controller
{
    // Hardcoded admin password (for demo; use env in production)
    private $adminPassword = 'Test1234';
    private $sessionKey = 'is_admin';
    private $sessionTimeout = 3600; // 1 hour in seconds

    public function login(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);
        if ($request->password === $this->adminPassword) {
            Session::put($this->sessionKey, true);
            Session::put('admin_login_time', time());
            return redirect()->route('admin.business.create.form');
        }
        return back()->with('error', 'Incorrect password.');
    }

    public function logout(Request $request)
    {
        Session::forget($this->sessionKey);
        Session::forget('admin_login_time');
        return redirect()->route('admin.login.form');
    }

    public function createBusinessForm(Request $request)
    {
        $business = \App\Models\Business::first();
        return view('admin_business_form', compact('business'));
    }

    public function storeBusiness(Request $request)
    {
        $request->validate([
            'location_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255',
            'business_name' => 'required|string|max:255',
            'business_address' => 'required|string|max:255',
        ]);

        // Update the first business if exists, otherwise create new
        $business = Business::first();
        if ($business) {
            $business->update($request->only(['location_name', 'phone_number', 'business_name', 'business_address']));
            $message = 'Business updated successfully!';
        } else {
            Business::create($request->only(['location_name', 'phone_number', 'business_name', 'business_address']));
            $message = 'Business added successfully!';
        }
        return back()->with('success', $message);
    }
}
