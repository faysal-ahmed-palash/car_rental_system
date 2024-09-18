@extends('frontend.layouts.app')

@section('title', 'Home')

@section('content')
    <h1>Welcome to Car Rental Service</h1>
    <p>Rent your favorite car for your next trip at affordable prices!</p>

    <h2>Available Cars</h2>
    <div class="car-list">
        @foreach($cars as $car)
            <div class="car-item">
                <img src="{{ asset('storage/cars/'.$car->image) }}" alt="{{ $car->name }}">
                <h3>{{ $car->name }} ({{ $car->brand }})</h3>
                <p>Price: ${{ $car->daily_rent_price }}/day</p>
                <a href="{{ route('frontend.cars.show', $car->id) }}">View Details</a>
            </div>
        @endforeach
    </div>
@endsection
