<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Concern;

class StudentConcernMail extends Mailable
{
    use Queueable, SerializesModels;

    public $concern;

    public function __construct(Concern $concern)
    {
        $this->concern = $concern;
    }

    public function build()
    {
        return $this->subject('New Student Concern: ' . $this->concern->concern_type)
                    ->view('emails.student_concern');
    }
}