<?php

namespace App\Http\Controllers;

use App\Models\Website;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    // Get all websites
    public function index()
    {
        return Website::all();
    }

    // Create a new website
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'nullable|string',
        ]);

        $website = Website::create($request->all());

        return response()->json($website, 201);
    }

    public function show(Website $website)
    {
        return response()->json($website);
    }

    public function update(Request $request, Website $website)
    {
        $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'url' => 'sometimes|nullable|string',
        ]);

        $website->update($request->all());

        return response()->json($website);
    }

    public function destroy(Website $website)
    {
        $website->delete();

        return response()->json(['message' => 'Website deleted successfully.']);
    }
}
