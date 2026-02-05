@extends('layouts.staff')
@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>SHS Waiting List (Validated Admissions)</h2>
    </div>

    <div class="card mb-4 shadow-sm">
        <div class="card-body p-4">
            <form method="GET" action="{{ route('staff.modules.waiting.shs') }}" class="row g-3">
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
                        <option value="11" {{ request('year_level') == '11' ? 'selected' : '' }}>Grade 11</option>
                        <option value="12" {{ request('year_level') == '12' ? 'selected' : '' }}>Grade 12</option>
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
                    <label for="search" class="form-label">Search by Name or Strand</label>
                    <input type="text" name="search" id="search" class="form-control"
                           placeholder="Enter student name or strand..." value="{{ request('search') }}">
                </div>
                <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">Filter</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Student ID Number</th>
                            <th>Student Names</th>
                            <th>Strand / Grade Level / Branch / Admission Date</th>
                            <th>Status</th>
                            <th>Payment</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                            <tr>
                                <td class="fw-bold {{ $student->studentNumber?->student_id_number ? 'text-primary' : 'text-danger' }}">
                                    {{ $student->studentNumber?->student_id_number ?? 'PENDING' }}
                                </td>
                                <td>
                                    {{ $student->last_name }}, {{ $student->first_name }}
                                    @if($student->middle_name) {{ substr($student->middle_name, 0, 1) }}. @endif
                                    {{ $student->extension_name }}
                                    <div class="text-muted small mt-1">
                                        <strong>Enrollee No:</strong> {{ $student->enrolleeNumber->enrollee_no ?? 'N/A' }}
                                    </div>
                                </td>
                                <td>
                                    <div><strong>{{ $student->enrollmentPreference?->course?->course_name ?? 'N/A' }}</strong></div>
                                    <div class="text-muted small">
                                        {{ $student->enrollmentPreference?->level?->level_name ?? 'N/A' }} |
                                        {{ $student->enrollmentPreference?->branch?->branch_name ?? 'N/A' }}
                                    </div>
                                    <div class="text-muted small mt-1">
                                        Admitted: {{ $student->created_at->format('M d, Y') }}
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-success">{{ $student->status->info_status ?? 'N/A' }}</span>
                                </td>
                                <td>
                                    <span class="badge {{ ($student->status->payment ?? '') === 'Paid' ? 'bg-success' : 'bg-warning text-dark' }}">
                                        {{ $student->status->payment ?? 'Unpaid' }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-primary" disabled>View</button>
                                    
                                    {{-- Paid Button Function Hidden/Commented Out but preserved --}}
                                    {{-- 
                                    @if(($student->status->payment ?? '') !== 'Paid')
                                    <form method="POST" action="{{ route('staff.shs.payment.update', $student->student_id) }}" style="display: inline;">
                                        @csrf
                                        <input type="hidden" name="payment" value="Paid">
                                        <button type="submit" class="btn btn-sm btn-success" onclick="return confirm('Confirm payment for this SHS student?')">Paid</button>
                                    </form>
                                    @endif 
                                    --}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">No validated SHS admissions found.</td>
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