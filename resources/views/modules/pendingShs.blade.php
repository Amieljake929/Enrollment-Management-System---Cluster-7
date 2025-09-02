<!-- resources/views/modules/pendingShs.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Pending Admissions - SHS</h2>
        <a href="#" class="btn btn-secondary"><i class="bi bi-download"></i> Download Admissions</a>
    </div>

    <!-- Filter & Search Form -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body p-4">
            <form method="GET" action="{{ route('modules.pending.shs') }}" class="row g-3">
                <div class="col-md-4">
                    <label for="branch" class="form-label">Filter by Branch</label>
                    <select name="branch" id="branch" class="form-select">
                        <option value="">All Branches</option>
                        <option value="1" {{ request('branch') == '1' ? 'selected' : '' }}>Main Branch</option>
                        <option value="2" {{ request('branch') == '2' ? 'selected' : '' }}>Bulacan Branch</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="year_level" class="form-label">Filter by Year Level</label>
                    <select name="year_level" id="year_level" class="form-select">
                        <option value="">All Levels</option>
                        <option value="11" {{ request('year_level') == '11' ? 'selected' : '' }}>Grade 11</option>
                        <option value="12" {{ request('year_level') == '12' ? 'selected' : '' }}>Grade 12</option>
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="search" class="form-label">Search by Keywords or Course</label>
                    <input type="text" name="search" id="search" class="form-control" placeholder="Enter student name or course..." value="{{ request('search') }}">
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
                            <th>Student Names</th>
                            <th>Course</th>
                            <th>Year Level | Branch</th>
                            <th>Admission Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
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
                                <td class="text-center">
                                    <a href="#" class="text-warning me-2" title="View"><i class="bi bi-eye fs-5"></i></a>
                                    <a href="#" class="text-info me-2" title="Send"><i class="bi bi-send fs-5"></i></a>
                                    <a href="#" class="text-danger" title="Delete"><i class="bi bi-trash fs-5"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    <i class="bi bi-clipboard-x fs-3"></i>
                                    <p class="mt-2 mb-0">No pending admissions found.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-end mt-3">
                {{ $students->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection