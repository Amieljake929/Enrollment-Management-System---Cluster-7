<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>All Students Data Report</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            font-size: 10px;
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
            width: 60px;
            height: auto;
        }

        .logo-right {
            position: absolute;
            right: 0;
            top: 4;
            width: 40px;
            height: auto;
        }

        .school-info {
            text-align: center;
            font-weight: bold;
            line-height: 1.4;
            margin: 0 auto;
            max-width: 60%;
            padding: 10px 0;
            font-size: 12px;
        }

        .report-title {
            text-align: center;
            margin: 20px 0 10px;
            font-size: 16px;
            font-weight: bold;
            color: #2c3e50;
        }

        .meta {
            text-align: center;
            font-size: 9px;
            color: #666;
            margin-bottom: 20px;
        }

        .filters-info {
            text-align: center;
            font-size: 9px;
            color: #555;
            margin-bottom: 15px;
            font-style: italic;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            margin-bottom: 20px;
            box-shadow: 0 0 5px rgba(0,0,0,0.05);
        }

        th, td {
            border: 1px solid #ddd;
            padding: 6px 8px;
            text-align: left;
            vertical-align: top;
        }

        th {
            background-color: #f8f9fa;
            font-weight: bold;
            color: #2c3e50;
            text-transform: uppercase;
            font-size: 9px;
        }

        tbody tr:nth-child(even) {
            background-color: #fcfcfc;
        }

        .section-title {
            font-size: 14px;
            font-weight: bold;
            color: #2c3e50;
            margin: 20px 0 10px 0;
            padding: 8px;
            background-color: #e9ecef;
            border-left: 4px solid #007bff;
        }

        .no-data {
            text-align: center;
            margin-top: 30px;
            font-style: italic;
            color: #777;
            font-size: 12px;
        }

        .student-type-badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .college-badge {
            background-color: #007bff;
            color: white;
        }

        .shs-badge {
            background-color: #28a745;
            color: white;
        }

        .status-badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 8px;
            font-weight: bold;
            text-transform: uppercase;
        }

        .pending-badge {
            background-color: #ffc107;
            color: #212529;
        }

        .validated-badge {
            background-color: #28a745;
            color: white;
        }

        .cancelled-badge {
            background-color: #dc3545;
            color: white;
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
        All Students Data Report
    </div>

    <!-- Meta Info -->
    <div class="meta">
        Generated on: {{ now()->format('F d, Y \a\t h:i A') }}
    </div>

    <!-- Filters Info -->
    @if(!$request->filled('download_all'))
        <div class="filters-info">
            @if($request->filled('student_type'))
                Student Type: {{ ucfirst($request->student_type) }} |
            @endif
            @if($request->filled('classification'))
                Classification: {{ $request->classification }} |
            @endif
            @if($request->filled('status'))
                Status: {{ $request->status }} |
            @endif
            @if($request->filled('date_from') || $request->filled('date_to'))
                Date Range: {{ $request->date_from ?? 'N/A' }} to {{ $request->date_to ?? 'N/A' }}
            @endif
        </div>
    @else
        <div class="filters-info">
            All data included (no filters applied)
        </div>
    @endif

    <!-- College Students Table -->
    @php
        $collegeStudents = $students->filter(function($student) {
            return isset($student->preference);
        });
    @endphp

    @if($collegeStudents->isNotEmpty())
        <div class="section-title">College Students</div>
        <table>
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Student Name</th>
                    <th>Course</th>
                    <th>Year Level</th>
                    <th>Branch</th>
                    <th>Status</th>
                    <th>Enrollee No.</th>
                    <th>Admission Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($collegeStudents as $student)
                    <tr>
                        <td>
                            <span class="student-type-badge college-badge">College</span><br>
                            {{ $student->type->type_name ?? 'N/A' }}
                        </td>
                        <td>
                            {{ $student->last_name }}, {{ $student->first_name }}
                            @if($student->middle_name)
                                {{ substr($student->middle_name, 0, 1) }}.
                            @endif
                            @if($student->extension_name)
                                {{ $student->extension_name }}
                            @endif
                        </td>
                        <td>{{ $student->preference->course->course_name ?? 'N/A' }}</td>
                        <td>{{ $student->preference->level->level_name ?? 'N/A' }}</td>
                        <td>{{ $student->preference->branch->branch_name ?? 'N/A' }}</td>
                        <td>
                            @if($student->status)
                                <span class="status-badge {{ strtolower($student->status->info_status) }}-badge">
                                    {{ $student->status->info_status }}
                                </span>
                            @else
                                <span class="status-badge pending-badge">Pending</span>
                            @endif
                        </td>
                        <td>{{ $student->enrolleeNumber->enrollee_no ?? 'N/A' }}</td>
                        <td>{{ $student->created_at->format('M d, Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    <!-- SHS Students Table -->
    @php
        $shsStudents = $students->filter(function($student) {
            return isset($student->enrollmentPreference);
        });
    @endphp

    @if($shsStudents->isNotEmpty())
        <div class="section-title">Senior High School Students</div>
        <table>
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Student Name</th>
                    <th>Strand</th>
                    <th>Year Level</th>
                    <th>Branch</th>
                    <th>Status</th>
                    <th>Enrollee No.</th>
                    <th>Admission Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($shsStudents as $student)
                    <tr>
                        <td>
                            <span class="student-type-badge shs-badge">SHS</span><br>
                            {{ $student->studentType->type_name ?? 'N/A' }}
                        </td>
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
                        <td>{{ $student->enrollmentPreference->level->level_name ?? 'N/A' }}</td>
                        <td>{{ $student->enrollmentPreference->branch->branch_name ?? 'N/A' }}</td>
                        <td>
                            @if($student->status)
                                <span class="status-badge {{ strtolower($student->status->info_status) }}-badge">
                                    {{ $student->status->info_status }}
                                </span>
                            @else
                                <span class="status-badge pending-badge">Pending</span>
                            @endif
                        </td>
                        <td>{{ $student->enrolleeNumber->enrollee_no ?? 'N/A' }}</td>
                        <td>{{ $student->created_at->format('M d, Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif

    @if($students->isEmpty())
        <p class="no-data">No students found matching the selected criteria.</p>
    @endif
</body>
</html>
