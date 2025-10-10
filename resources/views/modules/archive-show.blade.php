@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Archived Record Details</h4>
                    <a href="{{ route('modules.archive') }}" class="btn btn-secondary">Back to Archive</a>
                </div>
                <div class="card-body">
                    @if($student)
                        <h5>Student Information</h5>
                        @if($log->category === 'College')
                            <p><strong>Full Name:</strong> {{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}</p>
                            <p><strong>Student ID:</strong> {{ $student->student_id }}</p>
                            <p><strong>Course:</strong> {{ $student->preference->course->course_name ?? 'N/A' }}</p>
                            <p><strong>Branch:</strong> {{ $student->preference->branch->branch_name ?? 'N/A' }}</p>
                            <p><strong>Year Level:</strong> {{ $student->preference->level->level_name ?? 'N/A' }}</p>
                        @else
                            <p><strong>Full Name:</strong> {{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }}</p>
                            <p><strong>Student ID:</strong> {{ $student->student_id }}</p>
                            <p><strong>Course:</strong> {{ $student->enrollmentPreference->course->course_name ?? 'N/A' }}</p>
                            <p><strong>Branch:</strong> {{ $student->enrollmentPreference->branch->branch_name ?? 'N/A' }}</p>
                            <p><strong>Year Level:</strong> {{ $student->enrollmentPreference->level->level_name ?? 'N/A' }}</p>
                        @endif
                        <h5>Archive Information</h5>
                        <p><strong>Archived By:</strong> {{ $log->admin_name }}</p>
                        <p><strong>Date Archived:</strong> {{ $log->created_at->format('Y-m-d H:i') }}</p>
                        <p><strong>Original Status:</strong> {{ $log->original_status }}</p>
                        <p><strong>Category:</strong> {{ $log->category }}</p>
                    @else
                        <p>Student record not found.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
