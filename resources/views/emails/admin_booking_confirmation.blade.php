<!DOCTYPE html>
<html>
<head>
    <title>New Booking Confirmation</title>
</head>
<body>
    <h1>New Booking Confirmation</h1>
    <p>A new booking has been confirmed.</p>
    <p>Car: {{ $booking->car->name }}</p>
    <p>User: {{ $booking->user->name }}</p>
    <p>Start Date: {{ $booking->start_date }}</p>
    <p>End Date: {{ $booking->end_date }}</p>
    <p>Total Cost: {{ $booking->total_cost }}</p>
    <p>Please review the booking details in the admin panel.</p>
</body>
</html>
