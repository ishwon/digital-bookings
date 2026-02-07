<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationRequest;
use App\Models\Agency;
use App\Models\Client;
use App\Models\Placement;
use App\Models\Reservation;
use App\Models\Salesperson;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ReservationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $reservations = Reservation::query()
            ->with(['client', 'agency', 'placement', 'salesperson'])
            ->latest()
            ->get();

        return view('reservations.index', compact('reservations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $clients = Client::query()->orderBy('company_name')->get();
        $agencies = Agency::query()->orderBy('company_name')->get();
        $placements = Placement::query()->orderBy('name')->get();
        $salespeople = Salesperson::query()->orderBy('first_name')->orderBy('last_name')->get();
        $channels = ['Run of site', 'Home & multimedia'];
        $scopes = ['Mauritius only', 'Worldwide'];

        return view('reservations.create', compact('clients', 'agencies', 'placements', 'salespeople', 'channels', 'scopes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReservationRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['dates_booked'] = json_decode($data['dates_booked'], true);

        Reservation::create($data);

        return redirect()->route('reservations.index')->with('success', 'Booking created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reservation $reservation): View
    {
        $reservation->load(['client', 'agency', 'placement', 'salesperson']);

        return view('reservations.show', compact('reservation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reservation $reservation): View
    {
        $clients = Client::query()->orderBy('company_name')->get();
        $agencies = Agency::query()->orderBy('company_name')->get();
        $placements = Placement::query()->orderBy('name')->get();
        $salespeople = Salesperson::query()->orderBy('first_name')->orderBy('last_name')->get();
        $channels = ['Run of site', 'Home & multimedia'];
        $scopes = ['Mauritius only', 'Worldwide'];

        return view('reservations.edit', compact('reservation', 'clients', 'agencies', 'placements', 'salespeople', 'channels', 'scopes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReservationRequest $request, Reservation $reservation): RedirectResponse
    {
        $data = $request->validated();
        $data['dates_booked'] = json_decode($data['dates_booked'], true);

        $reservation->update($data);

        return redirect()->route('reservations.index')->with('success', 'Booking updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reservation $reservation): RedirectResponse
    {
        $reservation->delete();

        return redirect()->route('reservations.index')->with('success', 'Booking deleted successfully.');
    }
}
