<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'url' => 'required|string|unique:pages,url|max:255',
            'location_name' => 'required|string|max:255',
        ]);

        $page = new Page();
        $page->url = $request->input('url');
        $page->location_name = $request->input('location_name');
        $page->save();

        return redirect()->back()->with('success', 'Page created successfully!');
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->back()->with('success', 'Page deleted successfully!');
    }
    
    
}
