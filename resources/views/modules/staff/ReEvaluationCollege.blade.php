@extends('layouts.staff')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Re-Evaluation - College</h2>
        {{-- Optional: PDF button kapag may controller na --}}
        {{-- <a href="{{ route('staff.modules.reevaluation.college.download.pdf', request()->query()) }}"
           class="btn btn-secondary" style="background-color: #5044e4">
            <i class="bi bi-download"></i> Download Re-Evaluations (PDF)
        </a> --}}
    </div>

    <!-- Filter & Search Form -->
    <div class="card mb-4 shadow-sm">
        <div class="card-body p-4">
            <form method="GET" action="{{ route('staff.modules.reevaluation.college') }}" class="row g-3">
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
                            <th>Student Type</th>
                            <th>Student Names</th>
                            <th>Course</th>
                            <th>Year Level | Branch</th>
                            <th>Status</th>
                            <th>Admission Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($students as $student)
                            <tr>
                                <td>{{ $student->type->type_name ?? 'N/A' }}</td>
                                <td>
                                    {{ $student->last_name }}, {{ $student->first_name }}
                                    @if($student->middle_name)
                                        {{ substr($student->middle_name, 0, 1) }}.
                                    @endif
                                    @if($student->extension_name)
                                        {{ $student->extension_name }}
                                    @endif
                                    <div class="text-muted small mt-1">
                                        <strong>Enrollee Number:</strong> {{ $student->enrolleeNumber->enrollee_no ?? 'N/A' }}
                                    </div>
                                </td>
                                <td>{{ $student->preference->course->course_name ?? 'N/A' }}</td>
                                <td>
                                    {{ $student->preference->level->level_name ?? 'N/A' }} |
                                    {{ $student->preference->branch->branch_name ?? 'N/A' }}
                                </td>
                                <td>
                                    @if($student->status)
                                        <span class="badge bg-warning text-dark">{{ $student->status->info_status }}</span>
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>{{ $student->created_at->format('M d, Y \a\t h:i A') }}</td>
                                <td class="text-center">
                                    <!-- View Button -->
                                    <button type="button" class="btn btn-sm btn-primary me-2 view-student"
                                        data-student-id="{{ $student->student_id }}" title="View">
                                        View
                                    </button>

                                    <!-- Validate Button -->
                                    <button type="button" class="btn btn-sm btn-success validate-btn me-2"
                                        data-student-id="{{ $student->student_id }}" title="Validate">
                                        Validate
                                    </button>

                                    <!-- Cancel Button -->
                                    <button type="button" class="btn btn-sm btn-danger cancel-btn"
                                        data-student-id="{{ $student->student_id }}"
                                        data-student-name="{{ $student->last_name }}, {{ $student->first_name }}"
                                        title="Cancel">
                                        Cancel
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    <i class="bi bi-clipboard-x fs-3"></i>
                                    <p class="mt-2 mb-0">No re-evaluation records found.</p>
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

<!-- Student Details Modal -->
<div class="modal fade" id="studentModal" tabindex="-1" aria-labelledby="studentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="studentModalLabel">Student Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="student-details">
                    <div class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- Scripts --}}
<script>
document.addEventListener('click', function(e) {
    const link = e.target.closest('.view-student');
    if (link) {
        e.preventDefault();
        const studentId = link.getAttribute('data-student-id');
        const modalElement = document.getElementById('studentModal');
        const modal = new bootstrap.Modal(modalElement);
        const modalBody = document.getElementById('student-details');
        modalBody.innerHTML = `
            <div class="text-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p>Loading student details...</p>
            </div>
        `;
        modal.show();

        fetch(`/staff/modules/pending/college/${studentId}`)
            .then(response => response.json())
            .then(data => {
                modalBody.innerHTML = generateStudentDetailsHTML(data);
            })
            .catch(error => {
                modalBody.innerHTML = '<div class="alert alert-danger">Error loading student details.</div>';
                console.error('Error:', error);
            });
    }
});

function generateStudentDetailsHTML(student) {
    return `
        <div class="row">
            <div class="col-md-6">
                <h6 class="fw-bold">Personal Information</h6>
                <p><strong>Full Name:</strong> ${student.last_name}, ${student.first_name} ${student.middle_name ? student.middle_name.charAt(0) + '.' : ''} ${student.extension_name || ''}</p>
                <p><strong>Gender:</strong> ${student.gender || 'N/A'}</p>
                <p><strong>Date of Birth:</strong> ${student.dob || 'N/A'}</p>
                <p><strong>Place of Birth:</strong> ${student.place_of_birth || 'N/A'}</p>
                <p><strong>Nationality:</strong> ${student.nationality || 'N/A'}</p>
                <p><strong>Civil Status:</strong> ${student.civil_status || 'N/A'}</p>
                <p><strong>Religion:</strong> ${student.religion || 'N/A'}</p>
                <p><strong>Indigenous Group:</strong> ${student.indigenous ? student.indigenous.indigenous_name : 'N/A'}</p>
                <p><strong>Disability:</strong> ${student.disability ? student.disability.disability_name : 'N/A'}</p>
            </div>
            <div class="col-md-6">
                <h6 class="fw-bold">Contact & Address</h6>
                <p><strong>Contact Number:</strong> ${student.contact_number || 'N/A'}</p>
                <p><strong>Email:</strong> ${student.email || 'N/A'}</p>
                <p><strong>Social Media:</strong> ${student.social_media || 'N/A'}</p>
                <p><strong>Current Address:</strong> ${student.current_address || 'N/A'}</p>
                <p><strong>City/Municipality:</strong> ${student.city_municipality || 'N/A'}</p>
                <p><strong>Province:</strong> ${student.province || 'N/A'}</p>
                <p><strong>ZIP Code:</strong> ${student.zip_code || 'N/A'}</p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <h6 class="fw-bold">Enrollment Preferences</h6>
                <p><strong>Course:</strong> ${student.preference ? student.preference.course.course_name : 'N/A'}</p>
                <p><strong>Year Level:</strong> ${student.preference ? student.preference.level.level_name : 'N/A'}</p>
                <p><strong>Branch:</strong> ${student.preference ? student.preference.branch.branch_name : 'N/A'}</p>
                <p><strong>Enrollee Number:</strong> ${student.enrollee_number ? student.enrollee_number.enrollee_no : 'N/A'}</p>
            </div>
            <div class="col-md-6">
                <h6 class="fw-bold">Educational Background</h6>
                ${student.educational_background ? `
                    <p><strong>Primary School:</strong> ${student.educational_background.primary_school || 'N/A'}</p>
                    <p><strong>Primary Year Graduated:</strong> ${student.educational_background.primary_year_graduated || 'N/A'}</p>
                    <p><strong>Secondary School:</strong> ${student.educational_background.secondary_school || 'N/A'}</p>
                    <p><strong>Secondary Year Graduated:</strong> ${student.educational_background.secondary_year_graduated || 'N/A'}</p>
                    <p><strong>Last School Attended:</strong> ${student.educational_background.last_school_attended || 'N/A'}</p>
                    <p><strong>Last School Year Graduated:</strong> ${student.educational_background.last_school_year_graduated || 'N/A'}</p>
                ` : '<p>No educational background information available.</p>'}
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <h6 class="fw-bold">Parent/Guardian Information</h6>
                ${student.parent_info && Array.isArray(student.parent_info) && student.parent_info.length > 0 ?
                    student.parent_info.map(parent => `
                        <div class="mb-3">
                            <p><strong>Name:</strong> ${parent.last_name}, ${parent.first_name} ${parent.middle_name ? parent.middle_name + '.' : ''}</p>
                            <p><strong>Relationship:</strong> ${parent.parent_type || 'N/A'}</p>
                            <p><strong>Contact:</strong> ${parent.contact_number || 'N/A'}</p>
                            <p><strong>Email:</strong> ${parent.email || 'N/A'}</p>
                            <p><strong>Occupation:</strong> ${parent.occupation || 'N/A'}</p>
                        </div>
                    `).join('') : '<p>No parent information available.</p>'}
                ${student.guardian ? `
                    <h6 class="fw-bold mt-3">Guardian</h6>
                    <p><strong>Name:</strong> ${student.guardian.last_name}, ${student.guardian.first_name} ${student.guardian.middle_name || ''}</p>
                    <p><strong>Contact:</strong> ${student.guardian.contact_number || 'N/A'}</p>
                ` : ''}
            </div>
            <div class="col-md-6">
                <h6 class="fw-bold">Uploaded Documents</h6>
                ${student.documents && student.documents.length > 0 ? `
                    <ul>
                        ${student.documents.map(doc => {
                            const url = `/storage/${doc.file_path}`;
                            return `<li>${doc.document ? doc.document.document_name : 'Unknown'}: <a href="${url}" target="_blank">View</a></li>`;
                        }).join('')}
                    </ul>
                ` : '<p>No documents uploaded.</p>'}
            </div>
        </div>
    `;
}
</script>

{{-- Validate & Cancel Scripts --}}
<script>
// Validate
document.addEventListener('click', function(e) {
    const btn = e.target.closest('.validate-btn');
    if (btn) {
        const id = btn.dataset.studentId;
        if (!confirm('Validate this re-evaluation? Status will become "Validated".')) return;
        fetch(`/staff/modules/pending/college/${id}/validate`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(r => r.json())
        .then(d => {
            if (d.success) {
                alert('Validated successfully!');
                location.reload();
            } else alert('Failed to validate.');
        })
        .catch(() => alert('An error occurred.'));
    }
});

// Cancel
document.addEventListener('click', function(e) {
    const btn = e.target.closest('.cancel-btn');
    if (btn) {
        const id = btn.dataset.studentId;
        const name = btn.dataset.studentName;
        if (!confirm(`Cancel re-evaluation for ${name}? Status will become "Cancelled".`)) return;
        fetch(`/staff/modules/pending/college/${id}/cancel`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(r => r.json())
        .then(d => {
            if (d.success) {
                alert('Cancelled successfully!');
                location.reload();
            } else alert('Failed to cancel.');
        })
        .catch(() => alert('An error occurred.'));
    }
});
</script>

@endsection
