<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enrollment Validated</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #5044e4;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 0 0 5px 5px;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #666;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>Bestlink College</h1>
        <h2>Enrollment Validated</h2>
    </div>
    <div class="content">
        <p>Dear {{ $student->first_name }} {{ $student->last_name }},</p>

        <p>Congratulations! Your enrollment has been successfully validated.</p>

        @if($enrolleeNo)
            <p><strong>Your Enrollee Number:</strong> {{ $enrolleeNo }}</p>
        @endif

        <p>You can now proceed with the next steps in your enrollment process. If you have any questions, please contact our admissions office.</p>

        <p>Best regards,<br>
        Bestlink College Admissions Team</p>
    </div>
    <div class="footer">
        <p>This is an automated message. Please do not reply to this email.</p>
    </div>
</body>
</html>
