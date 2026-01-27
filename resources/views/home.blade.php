@extends('layouts.main')

@section('content')
  <main class="flex-1 bg-white">
    <div class="px-12 py-10">
      <h1 class="text-2xl font-semibold text-gray-900">Home</h1>
      <div class="mt-6 h-px w-full bg-gray-100"></div>

      <!-- Empty state area (like screenshot whitespace) -->
      <div class="mt-10 rounded-2xl border border-dashed border-gray-200 bg-white p-10 text-sm text-gray-500">
        Your dashboard content goes here (bookings calendar, availability, recent activity, etc.).
      </div>
    </div>
  </main>
@endsection
