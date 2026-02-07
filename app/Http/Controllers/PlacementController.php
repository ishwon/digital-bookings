<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlacementRequest;
use App\Models\Placement;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PlacementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $placements = Placement::query()->latest()->get();

        return view('placements.index', compact('placements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('placements.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PlacementRequest $request): RedirectResponse
    {
        Placement::create($request->validated());

        return redirect()->route('placements.index')->with('success', 'Placement created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Placement $placement): View
    {
        return view('placements.show', compact('placement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Placement $placement): View
    {
        return view('placements.edit', compact('placement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PlacementRequest $request, Placement $placement): RedirectResponse
    {
        $placement->update($request->validated());

        return redirect()->route('placements.index')->with('success', 'Placement updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Placement $placement): RedirectResponse
    {
        $placement->delete();

        return redirect()->route('placements.index')->with('success', 'Placement deleted successfully.');
    }
}
