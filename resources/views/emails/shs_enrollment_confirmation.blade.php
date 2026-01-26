<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>SHS Enrollment Confirmation</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2 style="color: #203B6B;">Bestlink College of the Philippines</h2>
        <p>Dear <strong>{{ $student->first_name }} {{ $student->last_name }}</strong>,</p>

        <p>Thank you for enrolling in our Senior High School program! Your enrollment has been successfully received.</p>

        <div style="background: #f9f9f9; padding: 15px; border-left: 4px solid #203B6B; margin: 20px 0;">
            <p><strong>Email:</strong> {{ $student->email }}</p>
            <p><strong>Preferred Course:</strong> 
                @php
                    $course = \App\Models\ShsCourse::find($student->enrollmentPreference?->course_id);
                @endphp
                {{ $course ? $course->course_name : 'N/A' }}
            </p>
        </div>


        <p>If you have questions, contact us at: <a href="mailto:bestlinkcollegeofph@gmail.com">info@bestlinkcollege.edu.ph</a></p>

        <hr style="margin: 30px 0;">
        <p style="font-size: 0.9em; color: #777;">
            &copy; {{ date('Y') }} Bestlink College of the Philippines. All rights reserved.
        </p>
    </div>
</body>
</html>