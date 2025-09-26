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
                                     <div class="text-muted small mt-1">
                                          <strong>Enrollee Number:</strong> {{ $student->enrolleeNumber->enrollee_no ?? 'N/A' }}
                                     </div>
                                </td>
                                <td>{{ $student->enrollmentPreference->course->course_name ?? 'N/A' }}</td>
                                <td>
                                    {{ $student->enrollmentPreference->level->level_name ?? 'N/A' }} | 
                                    {{ $student->enrollmentPreference->branch->branch_name ?? 'N/A' }}
                                </td>
                                <td>{{ $student->created_at->format('M d, Y \a\t h:i A') }}</td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-link text-warning p-0 view-shs-btn" 
        data-student-id="{{ $student->student_id }}" 
        title="View">
    <i class="bi bi-eye fs-5"></i>
</button>
<a href="#" class="text-info me-2" title="Send"><i class="bi bi-send fs-5"></i></a>
<button type="button" class="btn btn-link text-danger p-0 delete-shs-btn" 
        data-student-id="{{ $student->student_id }}" 
        data-student-name="{{ $student->last_name }}, {{ $student->first_name }}"
        title="Delete">
    <i class="bi bi-trash fs-5"></i>
</button>
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

<!-- SHS Student Details Modal -->
<div class="modal fade" id="shsStudentModal" tabindex="-1" aria-labelledby="shsStudentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="shsStudentModalLabel">SHS Student Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="shs-student-details">
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

<!-- SHS Delete Confirmation Modal -->
<div class="modal fade" id="shsDeleteConfirmationModal" tabindex="-1" aria-labelledby="shsDeleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="shsDeleteConfirmationModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the SHS admission record for <strong id="shs-student-name-to-delete"></strong>?</p>
                <p class="text-danger"><small>This action cannot be undone. All related data will also be permanently deleted.</small></p>
            </div>
            <div class="modal-footer">
                <form id="shs-delete-form" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-danger">Yes, Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
// View SHS Student
document.addEventListener('click', function(e) {
    const viewBtn = e.target.closest('.view-shs-btn');
    if (viewBtn) {
        e.preventDefault();
        const studentId = viewBtn.getAttribute('data-student-id');
        const modalElement = document.getElementById('shsStudentModal');
        const modal = new bootstrap.Modal(modalElement);
        const modalBody = document.getElementById('shs-student-details');

        modalBody.innerHTML = `
            <div class="text-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p>Loading student details...</p>
            </div>
        `;
        modal.show();

        fetch(`/modules/pending/shs/${studentId}`)
            .then(response => response.json())
            .then(data => {
                modalBody.innerHTML = generateShsStudentDetailsHTML(data);
            })
            .catch(error => {
                modalBody.innerHTML = '<div class="alert alert-danger">Error loading student details.</div>';
                console.error('Fetch error:', error);
            });
    }

    // Delete SHS Student
    const deleteBtn = e.target.closest('.delete-shs-btn');
    if (deleteBtn) {
        e.preventDefault();
        const studentId = deleteBtn.getAttribute('data-student-id');
        const studentName = deleteBtn.getAttribute('data-student-name');

        document.getElementById('shs-student-name-to-delete').textContent = studentName;
        const deleteForm = document.getElementById('shs-delete-form');
        deleteForm.action = `/modules/pending/shs/${studentId}`;

        const modal = new bootstrap.Modal(document.getElementById('shsDeleteConfirmationModal'));
        modal.show();
    }
});

// Handle SHS delete form submit
document.getElementById('shs-delete-form')?.addEventListener('submit', function(e) {
    e.preventDefault();
    const form = this;
    const url = form.action;

    fetch(url, {
        method: 'POST',
        body: new FormData(form),
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            bootstrap.Modal.getInstance(document.getElementById('shsDeleteConfirmationModal')).hide();
            alert('Record deleted successfully!');
            location.reload();
        } else {
            alert('Failed to delete.');
        }
    })
    .catch(() => alert('An error occurred.'));
});

// Generate SHS Student Details HTML
function generateShsStudentDetailsHTML(student) {
    return `
        <div class="row">
            <div class="col-md-6">
                <h6 class="fw-bold">Personal Information</h6>
                <p><strong>Full Name:</strong> ${student.last_name}, ${student.first_name} ${student.middle_name ? student.middle_name.charAt(0) + '.' : ''} ${student.extension_name || ''}</p>
                <p><strong>LRN:</strong> ${student.lrn || 'N/A'}</p>
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
                <p><strong>Course:</strong> ${student.enrollment_preference ? student.enrollment_preference.course.course_name : 'N/A'}</p>
                <p><strong>Year Level:</strong> ${student.enrollment_preference ? student.enrollment_preference.level.level_name : 'N/A'}</p>
                <p><strong>Branch:</strong> ${student.enrollment_preference ? student.enrollment_preference.branch.branch_name : 'N/A'}</p>
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
                <h6 class="fw-bold">Parent Information</h6>
                ${student.parent_info ? `
                    <div class="mb-3">
                        <h6>Father</h6>
                        <p><strong>Name:</strong> ${student.parent_info.father_last_name}, ${student.parent_info.father_first_name} ${student.parent_info.father_middle_name ? student.parent_info.father_middle_name + '.' : ''}</p>
                        <p><strong>Occupation:</strong> ${student.parent_info.father_occupation || 'N/A'}</p>
                        <p><strong>Contact:</strong> ${student.parent_info.father_contact || 'N/A'}</p>
                        <p><strong>Email:</strong> ${student.parent_info.father_email || 'N/A'}</p>
                    </div>
                    <div class="mb-3">
                        <h6>Mother</h6>
                        <p><strong>Name:</strong> ${student.parent_info.mother_last_name}, ${student.parent_info.mother_first_name} ${student.parent_info.mother_middle_name ? student.parent_info.mother_middle_name + '.' : ''}</p>
                        <p><strong>Occupation:</strong> ${student.parent_info.mother_occupation || 'N/A'}</p>
                        <p><strong>Contact:</strong> ${student.parent_info.mother_contact || 'N/A'}</p>
                        <p><strong>Email:</strong> ${student.parent_info.mother_email || 'N/A'}</p>
                    </div>
                ` : '<p>No parent information available.</p>'}
                ${student.guardian ? `
                    <h6 class="fw-bold mt-3">Guardian</h6>
                    <p><strong>Name:</strong> ${student.guardian.last_name}, ${student.guardian.first_name} ${student.guardian.middle_name ? student.guardian.middle_name + '.' : ''}</p>
                    <p><strong>Contact:</strong> ${student.guardian.contact_number || 'N/A'}</p>
                    <p><strong>Email:</strong> ${student.guardian.email || 'N/A'}</p>
                ` : ''}
            </div>
            <div class="col-md-6">
                <h6 class="fw-bold">Uploaded Documents</h6>
                ${student.documents && student.documents.length > 0 ? `
                    <ul>
                        ${student.documents.map(doc => {
                            const url = '/storage/' + doc.file_path;
                            return `<li>${doc.document ? doc.document.document_name : 'Unknown'}: <a href="${url}" target="_blank">View</a></li>`;
                        }).join('')}
                    </ul>
                ` : '<p>No documents uploaded.</p>'}
            </div>
        </div>
    `;
}
</script>

@endsection