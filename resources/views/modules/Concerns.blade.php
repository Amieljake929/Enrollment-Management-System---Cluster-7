@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-secondary mb-0">Student Concerns <span class="text-primary">| Inbox</span></h2>
            <p class="text-muted small mb-0">Manage and respond to student inquiries and technical issues.</p>
        </div>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <div class="input-group shadow-sm">
                <span class="input-group-text bg-white border-end-0"><i class="fas fa-filter text-muted small"></i></span>
                <select id="categoryFilter" class="form-select border-start-0 fw-500">
                    <option value="all">All Concern Types</option>
                    <option value="Payment and Billing Issues">Payment and Billing Issues</option>
                    <option value="Subject Loading and Schedule Conflicts">Subject Loading and Schedule Conflicts</option>
                    <option value="Account Access and Technical Support">Account Access and Technical Support</option>
                    <option value="Credentials and Document Submission">Credentials and Document Submission</option>
                    <option value="Change of Status">Change of Status</option>
                    <option value="Others">Others</option>
                </select>
            </div>
        </div>
        <div class="col-md-5">
            <div class="input-group shadow-sm">
                <span class="input-group-text bg-white border-end-0"><i class="fas fa-search text-muted small"></i></span>
                <input type="text" id="searchInput" class="form-control border-start-0 ps-0" placeholder="Search by name, email, or message...">
            </div>
        </div>
        <div class="col-md-3 text-end">
            <button class="btn btn-outline-secondary shadow-sm w-100 fw-500" onclick="location.reload()">
                <i class="fas fa-sync-alt me-1"></i> Refresh List
            </button>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="concernsTable">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 text-uppercase fs-7 text-muted">Student Information</th>
                            <th class="py-3 text-uppercase fs-7 text-muted">Category</th>
                            <th class="py-3 text-uppercase fs-7 text-muted">Preview</th>
                            <th class="py-3 text-uppercase fs-7 text-muted text-center">Status</th>
                            <th class="py-3 text-uppercase fs-7 text-muted">Date</th>
                            <th class="pe-4 py-3 text-center text-uppercase fs-7 text-muted">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($concerns as $concern)
                            <tr class="concern-row" data-category="{{ $concern->concern_type }}">
                                <td class="ps-4 py-3">
                                    <div class="fw-bold text-dark">{{ $concern->last_name }}, {{ $concern->first_name }}</div>
                                    <div class="text-muted small">{{ $concern->email }}</div>
                                    <span class="badge bg-primary-subtle text-primary mt-1" style="font-size: 0.7rem;">{{ $concern->student_type }}</span>
                                </td>
                                <td>
                                    <span class="badge rounded-pill bg-light text-dark border px-3">
                                        {{ $concern->concern_type }}
                                    </span>
                                </td>
                                <td>
                                    <div class="text-muted small text-truncate" style="max-width: 180px;">
                                        {{ $concern->concern }}
                                    </div>
                                </td>
                                <td class="text-center">
                                    @php
                                        $statusClass = match($concern->status) {
                                            'Pending' => 'bg-warning-subtle text-warning border-warning',
                                            'Assigned' => 'bg-info-subtle text-info border-info',
                                            'Completed' => 'bg-success-subtle text-success border-success',
                                            'Rejected' => 'bg-danger-subtle text-danger border-danger',
                                            default => 'bg-secondary-subtle text-secondary'
                                        };
                                    @endphp
                                    <span class="badge border px-3 {{ $statusClass }}">{{ $concern->status }}</span>
                                </td>
                                <td class="text-muted small text-nowrap">
                                    {{ $concern->submission_date ? $concern->submission_date->format('M d, Y') : 'N/A' }}
                                </td>
                                <td class="pe-4 py-3 text-center">
                                    <button class="btn btn-primary btn-sm rounded-pill px-4 shadow-sm view-concern" 
                                            data-concern-id="{{ $concern->id }}">
                                        View
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
                                    <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="50" class="opacity-25 mb-2">
                                    <p class="text-muted mb-0">No concerns recorded yet.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="concernModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <div class="modal-header bg-light border-0">
                <h5 class="modal-title fw-bold"><i class="fas fa-info-circle me-2 text-primary"></i>Concern Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4" id="concern-details">
                </div>
        </div>
    </div>
</div>

<style>
    body { background-color: #f4f7f6; }
    .fs-7 { font-size: 0.7rem; font-weight: 600; letter-spacing: 0.05em; }
    .fw-500 { font-weight: 500; }
    .bg-warning-subtle { background-color: #fff3cd !important; color: #856404 !important; }
    .bg-success-subtle { background-color: #d4edda !important; color: #155724 !important; }
    .bg-info-subtle { background-color: #d1ecf1 !important; color: #0c5460 !important; }
    .bg-danger-subtle { background-color: #f8d7da !important; color: #721c24 !important; }
    .bg-primary-subtle { background-color: #e7f1ff !important; color: #0d6efd !important; }
    .form-select, .form-control { border-radius: 8px; font-size: 0.9rem; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchInput');
    const categoryFilter = document.getElementById('categoryFilter');
    const rows = document.querySelectorAll('.concern-row');

    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedCategory = categoryFilter.value;

        rows.forEach(row => {
            const text = row.innerText.toLowerCase();
            const category = row.getAttribute('data-category');

            const matchesSearch = text.includes(searchTerm);
            const matchesCategory = (selectedCategory === 'all' || category === selectedCategory);

            row.style.display = (matchesSearch && matchesCategory) ? '' : 'none';
        });
    }

    searchInput.addEventListener('input', filterTable);
    categoryFilter.addEventListener('change', filterTable);

    // View Modal Logic
    document.addEventListener('click', function(e) {
        const btn = e.target.closest('.view-concern');
        if (btn) {
            const id = btn.getAttribute('data-concern-id');
            const modal = new bootstrap.Modal(document.getElementById('concernModal'));
            const container = document.getElementById('concern-details');

            container.innerHTML = `<div class="text-center py-5"><div class="spinner-border text-primary"></div></div>`;
            modal.show();

            fetch(`/modules/concerns/${id}`)
                .then(res => res.json())
                .then(data => {
                    container.innerHTML = `
                        <div class="row g-4">
                            <div class="col-md-6">
                                <label class="text-muted small text-uppercase fw-bold">Student Name</label>
                                <p class="fw-bold mb-3">${data.last_name}, ${data.first_name} ${data.middle_name || ''}</p>
                                <label class="text-muted small text-uppercase fw-bold">Email Address</label>
                                <p class="mb-3">${data.email}</p>
                                <label class="text-muted small text-uppercase fw-bold">Student Type</label>
                                <p><span class="badge bg-primary">${data.student_type}</span></p>
                            </div>
                            <div class="col-md-6 border-start ps-4">
                                <label class="text-muted small text-uppercase fw-bold">Category</label>
                                <p class="text-primary fw-bold mb-3">${data.concern_type}</p>
                                <label class="text-muted small text-uppercase fw-bold">Status</label>
                                <p><span class="badge bg-warning text-dark">${data.status}</span></p>
                                <label class="text-muted small text-uppercase fw-bold">Date Received</label>
                                <p class="small text-muted">${new Date(data.submission_date).toLocaleString()}</p>
                            </div>
                            <div class="col-12">
                                <div class="p-3 rounded-3 bg-light border">
                                    <label class="text-muted small text-uppercase fw-bold d-block mb-2">Message Detail</label>
                                    <div style="white-space: pre-wrap;">${data.concern}</div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-4 d-flex justify-content-end gap-2">
                            <button class="btn btn-secondary btn-sm px-4 rounded-pill" data-bs-dismiss="modal">Close</button>
                        </div>
                    `;
                });
        }
    });
});
</script>
@endsection