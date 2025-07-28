<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Business;
use App\Models\Button;
use Illuminate\Support\Facades\Storage;

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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $business = Business::first();
        $data = $request->only(['location_name', 'phone_number', 'business_name', 'business_address']);

        if ($request->hasFile('image')) {
            // Store the image in the public/business directory
            $path = $request->file('image')->store('business', 'public');

            // Extract only the filename for DB (relative to 'business/')
            $data['image'] = basename($path);

            // Delete old image if exists
            if (!empty($business?->image)) {
                Storage::disk('public')->delete('business/' . $business->image);
            }
        }

        if ($business) {
            $business->update($data);
            $message = 'Business updated successfully!';
        } else {
            Business::create($data);
            $message = 'Business added successfully!';
        }
        return back()->with('success', $message);
    }

    public function listButtons(Request $request)
    {
        $buttons = Button::all();
        return view('admin_buttons', compact('buttons'));
    }

    public function storeButton(Request $request)
    {
        $request->validate([
            'text' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'target' => 'required|string|max:20',
        ]);
        Button::create($request->only(['text', 'url', 'target']));
        return redirect()->back()->with('success', 'Button added!');
    }

    public function updateButton(Request $request, Button $button)
    {
        $request->validate([
            'text' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'target' => 'required|string|max:20',
        ]);
        $button->update($request->only(['text', 'url', 'target']));
        return redirect()->back()->with('success', 'Button updated!');
    }

    public function deleteButton(Button $button)
    {
        $button->delete();
        return redirect()->back()->with('success', 'Button deleted!');
    }
}
