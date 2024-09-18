<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserBookingConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;

    /**
     * Create a new message instance.
     *
     * @param $booking
     * @return void
     */
    public function __construct($booking)
    {
        $this->booking = $booking;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.user_booking_confirmation')
                    ->with([
                        'booking' => $this->booking,
                    ]);
    }
}
