<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pending SHS Admissions Report</title>
    <style>
        body { font-family: Arial, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #333; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { margin: 0; }
        .meta { font-size: 10px; color: #666; margin-bottom: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>Pending SHS Admissions Report</h2>
        <div class="meta">
            Generated on: {{ now()->format('F d, Y \a\t h:i A') }}
        </div>
    </div>

    @if($students->isEmpty())
        <p style="text-align: center; margin-top: 30px;">No pending SHS admissions found.</p>
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