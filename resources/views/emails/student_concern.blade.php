<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { width: 80%; margin: auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px; }
        .header { background: #203B6B; color: white; padding: 10px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { padding: 20px; }
        .footer { font-size: 12px; color: #777; text-align: center; margin-top: 20px; }
        .label { font-weight: bold; color: #203B6B; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>New Student Concern</h2>
        </div>
        <div class="content">
            <p><span class="label">Student Name:</span> {{ $concern->first_name }} {{ $concern->last_name }}</p>
            <p><span class="label">Email:</span> {{ $concern->email }}</p>
            <p><span class="label">Student Type:</span> {{ $concern->student_type }}</p>
            <p><span class="label">Category:</span> {{ $concern->concern_type }}</p>
            <hr>
            <p><span class="label">Concern Message:</span></p>
            <p style="background: #f9f9f9; padding: 15px; border-left: 5px solid #203B6B;">
                {!! nl2br(e($concern->concern)) !!}
            </p>
        </div>
        <div class="footer">
            Bestlink College of the Philippines - Concern Management System
        </div>
    </div>
</body>
</html>