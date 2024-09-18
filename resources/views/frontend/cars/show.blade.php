<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $car->name }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    @include('frontend.partials.header')

    <div class="container mt-4">
        <h1>{{ $car->name }}</h1>
        <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->name }}" class="img-fluid">
        <p>Brand: {{ $car->brand }}</p>
        <p>Model: {{ $car->model }}</p>
        <p>Year: {{ $car->year }}</p>
        <p>Type: {{ $car->car_type }}</p>
        <p>Daily Rent: ${{ $car->daily_rent_price }}</p>
        <a href="{{ route('frontend.rentals.create', ['car' => $car->id]) }}" class="btn btn-primary">Book Now</a>
    </div>

    @include('frontend.partials.footer')
</body>
</html>
