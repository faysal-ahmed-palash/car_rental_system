<!DOCTYPE html>
<html>
<head>
    <title>Booking Confirmation</title>
</head>
<body>
    <h1>Booking Confirmation</h1>
    <p>Dear {{ $booking->user->name }},</p>
    <p>Your booking for the car "{{ $booking->car->name }}" has been confirmed.</p>
    <p>Start Date: {{ $booking->start_date }}</p>
    <p>End Date: {{ $booking->end_date }}</p>
    <p>Total Cost: {{ $booking->total_cost }}</p>
    <p>Thank you for choosing our service.</p>
</body>
</html>
