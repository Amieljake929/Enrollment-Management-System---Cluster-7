<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnrollmentSubmittedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $student; // public para ma-access sa blade

    public function __construct($student)
    {
        $this->student = $student;
    }

    public function build()
    {
        return $this->subject('Enrollment Received')
            ->markdown('emails.enrollment.submitted');
    }
}
