@extends('layouts.staff')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>College Waiting List (Validated Admissions)</h2>
        {{-- Optional: Add PDF download later if needed --}}
    </div>

    <!-- Filter & Search Form (same as pending) -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body p-4">
            <form method="GET" action="{{ route('staff.modules.waiting.college') }}" class="row g-3">
                <div class="col-md-3">
                    <label for="branch" class="form-label">Filter by Branch</label>
                    <select name="branch" id="branch" class="form-select">
                        <option value="">All Branches</option>
                        <option value="1" {{ request('branch') == '1' ? 'selected' : '' }}>Main Branch</option>
                        <option value="2" {{ request('branch') == '2' ? 'selected' : '' }}>Bulacan Branch</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="year_level" class="form-label">Filter by Year Level</label>
                    <select name="year_level" id="year_level" class="form-select">
                        <option value="">All Levels</option>
                        <option value="1" {{ request('year_level') == '1' ? 'selected' : '' }}>1st Year</option>
                        <option value="2" {{ request('year_level') == '2' ? 'selected' : '' }}>2nd Year</option>
                        <option value="3" {{ request('year_level') == '3' ? 'selected' : '' }}>3rd Year</option>
                        <option value="4" {{ request('year_level') == '4' ? 'selected' : '' }}>4th Year</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="student_type" class="form-label">Filter by Student Type</label>
                    <select name="student_type" id="student_type" class="form-select">
                        <option value="">All Types</option>
                        @foreach($studentTypes as $type)
                            <option value="{{ $type->type_id }}" {{ request('student_type') == $type->type_id ? 'selected' : '' }}>
                                {{ $type->type_name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="search" class="form-label">Search by Name or Course</label>
                    <input type="text" name="search" id="search" class="form-control"
                           placeholder="Enter student name or course..." value="{{ request('search') }}">
                </div>
                <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Student Table -->
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Student ID Number</th>
                            <th>Assigned Sections</th>
                            <th>Student Names</th>
                            <th>Course / Year Level / Branch / Admission Date</th>
                            <th>Status</th>
                            <th>Payment</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                            <tr>
                                <td>{{ $student->student_id_number }}</td>
                                <td class="text-muted">—</td> {{-- Placeholder for Assigned Sections --}}
                                <td>
                                    {{ $student->last_name }}, {{ $student->first_name }}
                                    @if($student->middle_name)
                                        {{ substr($student->middle_name, 0, 1) }}.
                                    @endif
                                    @if($student->extension_name)
                                        {{ $student->extension_name }}
                                    @endif
                                    <div class="text-muted small mt-1">
                                        <strong>Enrollee No:</strong> {{ $student->enrolleeNumber->enrollee_no ?? 'N/A' }}
                                    </div>
                                </td>
                                <td>
                                    <div><strong>{{ $student->preference?->course?->course_name ?? 'N/A' }}</strong></div>
                                    <div class="text-muted small">
                                        {{ $student->preference?->level?->level_name ?? 'N/A' }} |
                                        {{ $student->preference?->branch?->branch_name ?? 'N/A' }}
                                    </div>
                                    <div class="text-muted small mt-1">
                                        Admitted: {{ $student->created_at->format('M d, Y') }}
                                    </div>
                                </td>
                                <td>
                                    @if($student->status)
                                        <span class="badge bg-success">{{ $student->status->info_status }}</span>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    @if($student->status)
                                        <span class="badge {{ $student->status->payment === 'Paid' ? 'bg-success' : 'bg-warning text-dark' }}">
                                            {{ $student->status->payment }}
                                        </span>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-primary me-2" disabled>View</button>
                                    <button type="button" class="btn btn-sm btn-danger" disabled>Cancel</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    <i class="bi bi-hourglass-split fs-3"></i>
                                    <p class="mt-2 mb-0">No validated admissions in waiting list.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-end mt-3">
                {{ $students->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection
