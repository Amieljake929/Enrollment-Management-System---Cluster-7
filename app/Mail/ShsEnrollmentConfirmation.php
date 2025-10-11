<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ShsEnrollmentConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $student;
    public $enrolleeNo;

    public function __construct($student, $enrolleeNo)
    {
        $this->student = $student;
        $this->enrolleeNo = $enrolleeNo;
    }

    public function build()
    {
        return $this->subject('Bestlink College - SHS Enrollment Confirmation')
                    ->view('emails.shs_enrollment_confirmation');
    }
}