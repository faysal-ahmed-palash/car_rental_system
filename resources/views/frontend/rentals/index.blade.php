@extends('frontend.layouts.app')

@section('title', 'My Rentals')

@section('content')
    <h1>My Rentals</h1>

    <div class="rental-list">
        @foreach($rentals as $rental)
            <div class="rental-item">
                <h3>{{ $rental->car->name }} ({{ $rental->car->brand }})</h3>
                <p>Rental Period: {{ $rental->rental_period }} days</p>
                <p>Total Cost: ${{ $rental->total_cost }}</p>
                <p>Status: {{ $rental->status }}</p>
            </div>
        @endforeach
    </div>
@endsection
