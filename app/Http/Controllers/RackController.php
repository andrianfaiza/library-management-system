<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rack;
use Illuminate\View\View;

class RackController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $racks = Rack::query()
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                      ->orWhere('location', 'like', "%{$search}%")
                      ->orWhere('capacity', 'like', "%{$search}%");
            })->get();

        return view('rack.index', compact('racks', 'search'));
    }

    public function create()
    {
        return view('rack.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'capacity' => 'required|string|max:255',
        ]);

        Rack::create($validated);
        return redirect()->route('rack.index')->with('success', 'Shelf added successfully');
    }

    public function edit(Rack $rack)
    {
        return view('rack.edit', compact('rack'));
    }

    public function update(Request $request, Rack $rack)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'capacity' => 'required|string|max:255',
        ]);

        $rack->update($validated);
        return redirect()->route('rack.index')->with('success', 'Shelf updated successfully');
    }

    public function destroy(Rack $rack)
    {
        $rack->delete();
        return redirect()->route('rack.index')->with('success', 'Shelf deleted successfully');
    }
}
