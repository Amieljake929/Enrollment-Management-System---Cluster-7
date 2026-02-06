<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnrollmentValidatedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $student;
    public $enrolleeNo;
    public $studentType; // 'college' or 'shs'

    public function __construct($student, $enrolleeNo, $studentType)
    {
        $this->student = $student;
        $this->enrolleeNo = $enrolleeNo;
        $this->studentType = $studentType;
    }

    public function build()
    {
        return $this->subject('Bestlink College - Enrollment Validated')
                    ->view('emails.enrollment_validated');
    }
}
