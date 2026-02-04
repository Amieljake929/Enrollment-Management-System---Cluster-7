@extends('layouts.staff')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold text-secondary mb-0">Student Records <span class="text-primary">| SHS</span></h2>
        
        <button class="btn btn-success btn-sm rounded-pill px-4 d-none shadow-sm" 
                id="global-back-btn" 
                onclick="goBackToSections()">
            <i class="fas fa-chevron-left me-1"></i> Back to Sections
        </button>
    </div>

    <div id="filterSection" class="mb-3">
        <ul class="nav nav-pills shs-pills p-2 bg-white shadow-sm rounded-3" id="shsTab" role="tablist">
            @foreach($strands as $code => $fullName)
                <li class="nav-item" role="presentation">
                    <button class="nav-link {{ $loop->first ? 'active' : '' }} fw-500 shs-tab-btn" 
                            id="tab-{{ Str::slug($code) }}" 
                            data-bs-toggle="pill" 
                            data-bs-target="#content-{{ Str::slug($code) }}" 
                            type="button" role="tab">
                        {{ $code }}
                    </button>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="tab-content" id="shsTabContent">
        @foreach($strands as $code => $fullName)
            <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" 
                 id="content-{{ Str::slug($code) }}" role="tabpanel">
                
                <div class="mb-3 d-flex gap-2">
                    <button class="btn btn-outline-primary btn-sm rounded-pill px-4 active grade-filter-btn" 
                            onclick="filterByGrade('{{ Str::slug($code) }}', 'all', this)">All</button>
                    <button class="btn btn-outline-primary btn-sm rounded-pill px-4 grade-filter-btn" 
                            onclick="filterByGrade('{{ Str::slug($code) }}', '11', this)">Grade 11</button>
                    <button class="btn btn-outline-primary btn-sm rounded-pill px-4 grade-filter-btn" 
                            onclick="filterByGrade('{{ Str::slug($code) }}', '12', this)">Grade 12</button>
                </div>

                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    <div class="card-header bg-white border-bottom py-3">
                        <h5 class="mb-0 fw-bold text-dark" id="title-{{ Str::slug($code) }}">{{ $fullName }}</h5>
                        <small class="text-muted" id="subtitle-{{ Str::slug($code) }}">List of available sections</small>
                    </div>

                    <div class="card-body p-0">
                        <div id="section-view-{{ Str::slug($code) }}">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered mb-0">
                                    <thead class="bg-light">
                                        <tr>
                                            <th class="ps-4 py-3 text-uppercase fs-7 text-muted">Sections</th>
                                            <th class="py-3 text-center text-uppercase fs-7 text-muted">Grade Level</th>
                                            <th class="py-3 text-center text-uppercase fs-7 text-muted">Number of Students</th>
                                            <th class="pe-4 py-3 text-center text-uppercase fs-7 text-muted" style="width: 200px;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody id="section-table-body-{{ Str::slug($code) }}">
                                        @php $sections = $groupedData[$code] ?? collect(); @endphp
                                        @forelse($sections as $sectionName => $data)
                                            <tr class="section-row-{{ Str::slug($code) }}" data-grade="{{ $data['grade_level'] ?? '' }}">
                                                <td class="ps-4 py-3 fw-500 text-dark">Section {{ $sectionName }}</td>
                                                <td class="py-3 text-center">
                                                    <span class="text-secondary fw-bold">{{ $data['grade_level'] ?? 'N/A' }}</span>
                                                </td>
                                                <td class="py-3 text-center">
                                                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle px-3">
                                                        {{ $data['student_count'] }} Students
                                                    </span>
                                                </td>
                                                <td class="pe-4 py-3 text-center">
                                                    <button class="btn btn-primary btn-sm rounded-pill px-4 shadow-sm" 
                                                            onclick="toggleView('{{ Str::slug($code) }}', true, '{{ $sectionName }}')">
                                                        View
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center py-5">
                                                    <img src="https://cdn-icons-png.flaticon.com/512/7486/7486744.png" width="50" class="opacity-25 mb-2">
                                                    <p class="text-muted mb-0">No sections found for this strand.</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div id="student-view-{{ Str::slug($code) }}" class="d-none">
                            <div class="table-responsive">
                                <table class="table table-hover table-bordered mb-0">
                                    <thead class="bg-dark text-white">
                                        <tr>
                                            <th class="ps-4 py-3 small">STUDENT ID</th>
                                            <th class="py-3 small">FULL NAME</th>
                                            <th class="py-3 small text-center">STATUS</th>
                                            <th class="py-3 small text-center">SECTION</th>
                                            <th class="py-3 small text-center">YEAR LEVEL</th>
                                            <th class="pe-4 py-3 text-center small">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sections as $sectionName => $data)
                                            @foreach($data['students'] as $student)
                                                <tr class="student-row-{{ Str::slug($code) }} d-none" 
                                                    data-section="{{ $sectionName }}">
                                                    <td class="ps-4 py-3 text-primary fw-bold">{{ $student['StudentID'] }}</td>
                                                    <td class="py-3 fw-500 text-dark">{{ $student['FullName'] }}</td>
                                                    <td class="py-3 text-center">
                                                        <span class="badge rounded-pill bg-success-subtle text-success border border-success px-3">
                                                            {{ $student['EnrollmentStatus'] }}
                                                        </span>
                                                    </td>
                                                    <td class="py-3 text-center text-muted">{{ $student['Section'] }}</td>
                                                    <td class="py-3 text-center text-muted">{{ $student['YearLevel'] }}</td>
                                                    <td class="pe-4 py-3 text-center">
                                                        <button class="btn btn-outline-secondary btn-xs rounded-circle">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> 
                </div> 
            </div>
        @endforeach
    </div>
</div>

<style>
    body { background-color: #f4f7f6; }
    .fs-7 { font-size: 0.75rem; letter-spacing: 0.05em; }
    .fw-500 { font-weight: 500; }
    .shs-pills { display: flex; flex-wrap: nowrap; overflow-x: auto; gap: 5px; scrollbar-width: none; }
    .shs-pills::-webkit-scrollbar { display: none; }
    .shs-pills .nav-link { color: #6c757d; border: 1px solid #dee2e6; border-radius: 8px; white-space: nowrap; transition: all 0.2s; }
    .shs-pills .nav-link.active { background-color: #0d6efd !important; color: white !important; box-shadow: 0 4px 10px rgba(13, 110, 253, 0.3); border-color: #0d6efd !important; }
    .disabled-tab { opacity: 0.5; pointer-events: none; background-color: #f8f9fa !important; color: #adb5bd !important; }
    .grade-filter-btn.active { background-color: #0d6efd !important; color: white !important; }
    .table-bordered, .table-bordered th, .table-bordered td { border: 1px solid #e9ecef !important; }
    .bg-success-subtle { background-color: #e8f5e9 !important; }
    .bg-primary-subtle { background-color: #e3f2fd !important; }
</style>

<script>
    let currentActiveSlug = '';

    function filterByGrade(slug, grade, btn) {
        const parent = btn.parentElement;
        parent.querySelectorAll('.grade-filter-btn').forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        const rows = document.querySelectorAll(`.section-row-${slug}`);
        rows.forEach(row => {
            const rowGrade = row.getAttribute('data-grade');
            if (grade === 'all' || rowGrade.toString().includes(grade)) {
                row.classList.remove('d-none');
            } else {
                row.classList.add('d-none');
            }
        });
    }

    function toggleView(slug, isStudentView, sectionName = '') {
        currentActiveSlug = slug;
        const sectionDiv = document.getElementById(`section-view-${slug}`);
        const studentDiv = document.getElementById(`student-view-${slug}`);
        const globalBackBtn = document.getElementById('global-back-btn');
        const subtitle = document.getElementById(`subtitle-${slug}`);
        const tabs = document.querySelectorAll('.shs-tab-btn');

        if (isStudentView) {
            document.querySelectorAll(`.student-row-${slug}`).forEach(row => row.classList.add('d-none'));
            document.querySelectorAll(`.student-row-${slug}[data-section="${sectionName}"]`).forEach(row => row.classList.remove('d-none'));

            sectionDiv.classList.add('d-none');
            studentDiv.classList.remove('d-none');
            globalBackBtn.classList.remove('d-none'); 
            subtitle.innerText = `Students enrolled in Section ${sectionName}`;
            
            tabs.forEach(tab => {
                if(!tab.classList.contains('active')) tab.classList.add('disabled-tab');
            });
        } else {
            sectionDiv.classList.remove('d-none');
            studentDiv.classList.add('d-none');
            globalBackBtn.classList.add('d-none'); 
            subtitle.innerText = "List of available sections";
            
            tabs.forEach(tab => tab.classList.remove('disabled-tab'));
        }
    }

    function goBackToSections() {
        if (currentActiveSlug) {
            toggleView(currentActiveSlug, false);
        }
    }
</script>
@endsection