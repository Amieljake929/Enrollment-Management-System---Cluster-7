<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pending SHS Admissions Report</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 20px;
            color: #333;
        }

        .header-container {
            width: 100%;
            position: relative;
            margin-bottom: 15px;
        }

        .logo-left {
            position: absolute;
            left: 0;
            top: 0;
            width: 80px;
            height: auto;
        }

        .logo-right {
            position: absolute;
            right: 0;
            top: 5;
            width: 50px;
            height: auto;
        }

        .school-info {
            text-align: center;
            font-weight: bold;
            line-height: 1.4;
            margin: 0 auto;
            max-width: 60%;
            padding: 10px 0;
        }

        .report-title {
            text-align: center;
            margin: 20px 0 10px;
            font-size: 18px;
            font-weight: bold;
            color: #2c3e50;
        }

        .meta {
            text-align: center;
            font-size: 10px;
            color: #666;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            box-shadow: 0 0 5px rgba(0,0,0,0.05);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px 12px;
            text-align: left;
        }

        th {
            background-color: #f8f9fa;
            font-weight: bold;
            color: #2c3e50;
            text-transform: uppercase;
            font-size: 11px;
        }

        tbody tr:nth-child(even) {
            background-color: #fcfcfc;
        }

        tbody tr:hover {
            background-color: #f5f7fa;
        }

        .no-data {
            text-align: center;
            margin-top: 30px;
            font-style: italic;
            color: #777;
        }
    </style>
</head>
<body>
    <!-- Logo & School Header -->
    <div class="header-container">
        <img src="{{ public_path('images/pcb.png') }}" alt="PCB Logo" class="logo-left">
        <img src="{{ public_path('images/bcp.png') }}" alt="BCP Logo" class="logo-right">

        <div class="school-info">
            BESTLINK COLLEGE OF THE PHILIPPINES<br>
            #1071 Brgy. Kaligayahan Quirino Hi-way Novaliches Quezon City
        </div>
    </div>

    <!-- Report Title -->
    <div class="report-title">
        Pending SHS Admissions Report
    </div>

    <!-- Meta Info -->
    <div class="meta">
        Generated on: {{ now()->format('F d, Y \a\t h:i A') }}
    </div>

    <!-- Table or No Data Message -->
    @if($students->isEmpty())
        <p class="no-data">No pending SHS admissions found.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th>Student Name</th>
                    <th>Course</th>
                    <th>Year Level | Branch</th>
                    <th>Admission Date</th>
                    <th>Enrollee No.</th>
                </tr>
            </thead>
            <tbody>
                @foreach($students as $student)
                    <tr>
                        <td>
                            {{ $student->last_name }}, {{ $student->first_name }}
                            @if($student->middle_name)
                                {{ substr($student->middle_name, 0, 1) }}.
                            @endif
                            @if($student->extension_name)
                                {{ $student->extension_name }}
                            @endif
                        </td>
                        <td>{{ $student->enrollmentPreference->course->course_name ?? 'N/A' }}</td>
                        <td>
                            {{ $student->enrollmentPreference->level->level_name ?? 'N/A' }} |
                            {{ $student->enrollmentPreference->branch->branch_name ?? 'N/A' }}
                        </td>
                        <td>{{ $student->created_at->format('M d, Y \a\t h:i A') }}</td>
                        <td>{{ $student->enrolleeNumber->enrollee_no ?? 'N/A' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>