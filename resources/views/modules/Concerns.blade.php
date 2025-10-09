<!-- resources/views/modules/Concerns.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Concerns</h2>
    </div>

    

    <!-- Concerns Table -->
    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Student Type</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Concern</th>
                            <th>Status</th>
                            <th>Submitted</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($concerns as $concern)
                            <tr>
                                <td>{{ $concern->student_type }}</td>
                                <td>
                                    {{ $concern->last_name }}, {{ $concern->first_name }}
                                    @if($concern->middle_name)
                                        {{ substr($concern->middle_name, 0, 1) }}.
                                    @endif
                                </td>
                                <td>{{ $concern->email }}</td>
                                <td>
                                    <div class="text-muted small">
                                        {{ Str::limit($concern->concern, 60) }}
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $badgeClass = match($concern->status) {
                                            'Pending' => 'bg-warning text-dark',
                                            'Assigned' => 'bg-info',
                                            'Completed' => 'bg-success',
                                            'Rejected' => 'bg-danger',
                                            default => 'bg-secondary'
                                        };
                                    @endphp
                                    <span class="badge {{ $badgeClass }}">{{ $concern->status }}</span>
                                </td>
                                <td class="text-muted small">
                                    {{ $concern->submission_date?->format('M d, Y g:i A') ?? 'N/A' }}
                                </td>
                                <td class="text-center">
                                    <button type="button" class="btn btn-sm btn-primary me-2 view-concern"
                                            data-concern-id="{{ $concern->id }}"
                                            title="View">
                                        View
                                    </button>
                                    <button type="button" class="btn btn-sm btn-success me-2" disabled>Assign</button>
                                    <button type="button" class="btn btn-sm btn-danger" disabled>Reject</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    <i class="bi bi-inbox fs-3"></i>
                                    <p class="mt-2 mb-0">No concerns found.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Concern Details Modal -->
<div class="modal fade" id="concernModal" tabindex="-1" aria-labelledby="concernModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="concernModalLabel">Concern Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="concern-details">
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

@endsection

{{-- EXACTLY LIKE pendingCollege.blade.php: JS at the END, outside @section --}}
<script>
document.addEventListener('click', function(e) {
    const link = e.target.closest('.view-concern');
    if (link) {
        e.preventDefault();
        const concernId = link.getAttribute('data-concern-id');
        const modalElement = document.getElementById('concernModal');
        const modal = new bootstrap.Modal(modalElement);
        const modalBody = document.getElementById('concern-details');

        // Show loading
        modalBody.innerHTML = `
            <div class="text-center">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p>Loading concern details...</p>
            </div>
        `;
        modal.show();

        // ✅ CORRECTED URL: /modules/concerns/{id}
        fetch(`/modules/concerns/${concernId}`)
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP ${response.status}: ${response.statusText}`);
                }
                return response.json();
            })
            .then(concern => {
                modalBody.innerHTML = `
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="fw-bold">Student Information</h6>
                            <p><strong>Student Type:</strong> ${concern.student_type}</p>
                            <p><strong>Full Name:</strong> ${concern.last_name}, ${concern.first_name} ${concern.middle_name ? concern.middle_name.charAt(0) + '.' : ''}</p>
                            <p><strong>Email:</strong> ${concern.email}</p>
                            <p><strong>Submission Date:</strong> ${concern.submission_date ? new Date(concern.submission_date).toLocaleString() : 'N/A'}</p>
                        </div>
                        <div class="col-md-6">
                            <h6 class="fw-bold">Status</h6>
                            <p>
                                <span class="badge ${concern.status === 'Pending' ? 'bg-warning text-dark' : 
                                   concern.status === 'Assigned' ? 'bg-info' : 
                                   concern.status === 'Completed' ? 'bg-success' : 'bg-danger'}">
                                    ${concern.status}
                                </span>
                            </p>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <h6 class="fw-bold">Concern Message</h6>
                            <div class="alert alert-light p-3 border">
                                ${concern.concern.replace(/\n/g, '<br>')}
                            </div>
                        </div>
                    </div>
                `;
            })
            .catch(error => {
                modalBody.innerHTML = `<div class="alert alert-danger">Error loading concern details: ${error.message}</div>`;
                console.error('Fetch error:', error);
            });
    }
});
</script>