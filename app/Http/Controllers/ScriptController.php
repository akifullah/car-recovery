<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Script;
use Illuminate\Http\Request;

class ScriptController extends Controller
{
    public function index()
    {
        $scripts = Script::latest()->get();
        $pages = Page::get();
        return view('scripts', compact('scripts', "pages"));
    }

    public function create()
    {
        return view('scripts.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'name'     => 'required|string|max:255',
            'scope'    => 'required|in:entire_website,single_page',
            'position' => 'required|in:head,body',
            'code'     => 'required',
            'page'     => 'nullable|array|max:255',
        ]);
        $data = $request->all();

        // dd($data);

        // If 'page' is present and is an array, store as JSON string in DB
        if (isset($data['page']) && is_array($data['page'])) {
            $data['page'] = json_encode($data['page']);
        }
        Script::create($data);

        return redirect()->route('scripts.index')
            ->with('success', 'Script added successfully.');
    }

    public function show(Script $script)
    {
        return view('scripts.show', compact('script'));
    }

    public function edit(Script $script)
    {
        $pages = Page::get();

        return view('edit_script', compact('script', "pages"));
    }

    public function update(Request $request, Script $script)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'scope'    => 'required|in:entire_website,single_page',
            'position' => 'required|in:head,body',
            'code'     => 'required',
            'page'     => 'nullable|array|max:255',
        ]);
        $data = $request->all();

        // If 'page' is present and is an array, store as JSON string in DB
        if (isset($data['page']) && is_array($data['page'])) {
            $data['page'] = json_encode($data['page']);
        }

        $script->update($data);

        return redirect()->route('scripts.index')
            ->with('success', 'Script updated successfully.');
    }

    public function destroy(Script $script)
    {
        $script->delete();

        return redirect()->route('scripts.index')
            ->with('success', 'Script deleted successfully.');
    }
}
