<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Browse Cars</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    @include('frontend.partials.header')

    <div class="container mt-4">
        <h1>Browse Cars</h1>
        
        <!-- Display available cars -->
        <div class="car-list">
            @foreach($cars as $car)
                <div class="car-item">
                    <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->name }}" class="img-fluid">
                    <h3>{{ $car->name }}</h3>
                    <p>Brand: {{ $car->brand }}</p>
                    <p>Model: {{ $car->model }}</p>
                    <p>Year: {{ $car->year }}</p>
                    <p>Type: {{ $car->car_type }}</p>
                    <p>Daily Rent: ${{ $car->daily_rent_price }}</p>
                    <a href="{{ route('frontend.cars.show', $car->id) }}" class="btn btn-primary">View Details</a>
                </div>
            @endforeach
        </div>
    </div>

    @include('frontend.partials.footer')
</body>
</html>
