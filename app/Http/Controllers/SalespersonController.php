<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalespersonRequest;
use App\Models\Salesperson;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SalespersonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $salespeople = Salesperson::query()->latest()->get();

        return view('salespeople.index', compact('salespeople'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('salespeople.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(SalespersonRequest $request): RedirectResponse
    {
        Salesperson::create($request->validated());

        return redirect()->route('salespeople.index')->with('success', 'Salesperson created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Salesperson $salesperson): View
    {
        return view('salespeople.edit', compact('salesperson'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SalespersonRequest $request, Salesperson $salesperson): RedirectResponse
    {
        $salesperson->update($request->validated());

        return redirect()->route('salespeople.index')->with('success', 'Salesperson updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Salesperson $salesperson): RedirectResponse
    {
        $salesperson->delete();

        return redirect()->route('salespeople.index')->with('success', 'Salesperson deleted successfully.');
    }
}
