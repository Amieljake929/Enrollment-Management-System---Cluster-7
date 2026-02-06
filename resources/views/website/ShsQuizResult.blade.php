@extends('layouts.assessment')

@section('content')
<div class="container-fluid py-5">
    <div class="max-w-4xl mx-auto">
        <div class="text-center mb-6">
            <h1 class="h2 fw-bold text-primary">SHS Strand Quiz Result</h1>
            <p class="text-muted">Based on your interests and strengths</p>
        </div>

        @if(isset($recommendations) && count($recommendations) > 0)
            <div class="card shadow-sm border-0 mb-6">
                <div class="card-body p-5">
                    <h2 class="h4 fw-semibold mb-4 text-success">Your Top 3 Recommended Strands</h2>
                    <p class="text-muted small mb-4"><i class="fas fa-play-circle text-primary"></i> <strong>Tip:</strong> Click on a strand card to watch an introductory video and see more details.</p>

                    @foreach($recommendations as $idx => $rec)
                        @php
                            $suffix = match($idx) { 0 => 'st', 1 => 'nd', 2 => 'rd', default => 'th' };
                            $bgColor = match($idx) { 0 => 'primary', 1 => 'info', 2 => 'secondary', default => 'secondary' };
                        @endphp
                        
                        <div class="strand-item mb-4 p-3 border rounded @if($rec['is_top']) border-primary bg-light-subtle @endif" 
                             style="cursor: pointer; transition: 0.3s;"
                             data-bs-toggle="modal" 
                             data-bs-target="#strandInfoModal"
                             data-strand="{{ $rec['strand'] }}"
                             data-fullname="{{ $rec['description'] }}"
                             data-info="{{ $rec['info'] }}"
                             data-video="{{ $rec['video'] }}">
                            
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h3 class="h5 mb-1 text-primary">{{ $rec['strand'] }}</h3>
                                    <p class="text-muted mb-2">{{ $rec['description'] }}</p>
                                    <small class="text-secondary">Interest Score: <strong>{{ $rec['local_score'] }}</strong></small>
                                </div>
                                <div class="text-end">
                                    <div class="badge bg-{{ $bgColor }} px-3 py-2">
                                        {{ $idx + 1 }}{{ $suffix }}
                                    </div>
                                    <div class="mt-1">
                                        <small>Confidence: <strong>{{ $rec['confidence'] }}%</strong></small>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-3">
                                <div class="progress" style="height: 12px;">
                                    <div class="progress-bar @if($rec['confidence'] >= 90) bg-success @elseif($rec['confidence'] >= 80) bg-info @elseif($rec['confidence'] >= 70) bg-warning @else bg-danger @endif" 
                                         role="progressbar" 
                                         style="width: {{ $rec['confidence'] }}%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="card shadow-sm border-0 mb-6">
                <div class="card-header bg-primary text-white">
                    <h4 class="h5 mb-0">Your Interest Profile</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Strand</th>
                                    <th>Description</th>
                                    <th class="text-end">Score</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($localScores as $strand => $score)
                                    <tr @if($loop->first) class="table-primary fw-bold" @endif>
                                        <td><strong>{{ $strand }}</strong></td>
                                        <td>{{ $allStrands[$strand] ?? 'N/A' }}</td>
                                        <td class="text-end">
                                            <span class="badge bg-secondary">{{ $score }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm border-0 mb-6">
                <div class="card-header bg-info text-white">
                    <h4 class="h5 mb-0">Why This Recommendation?</h4>
                </div>
                <div class="card-body">
                    <p class="lead text-dark">{{ $narrative }}</p>
                </div>
            </div>

        @else
            <div class="text-center p-5 bg-light border rounded mb-6">
                <h3 class="text-danger">No Recommendation Available</h3>
            </div>
        @endif

        <div class="mt-6 p-4 rounded-3 border bg-white shadow-sm small text-muted">
            <h6 class="text-dark fw-bold"><i class="fas fa-exclamation-circle text-warning me-2"></i>Disclaimer</h6>
            <p>This result is generated by AI and serves as a guide for Senior High School strand selection.</p>
        </div>

        <div class="text-center mt-4 d-flex justify-content-center gap-3 flex-wrap">
            <a href="{{ route('quiz.show') }}" class="btn btn-outline-primary btn-lg px-5">Take Quiz Again</a>
            <button type="button" class="btn btn-success btn-lg px-5" data-bs-toggle="modal" data-bs-target="#ratingModal">Enroll Now</button>
        </div>
    </div>
</div>

<div class="modal fade" id="strandInfoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title"><i class="fas fa-graduation-cap me-2"></i>Strand Exploration</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="row g-4">
                    <div class="col-lg-5">
                        <h4 id="modalStrandTitle" class="text-primary mb-1"></h4>
                        <p id="modalStrandFull" class="text-muted fw-bold mb-3 small"></p>
                        <hr>
                        <h6>What is this strand about?</h6>
                        <p id="modalStrandDescription" class="text-dark" style="text-align: justify;"></p>
                    </div>
                    <div class="col-lg-7">
                        <div class="ratio ratio-16x9 shadow rounded overflow-hidden bg-dark">
                            <iframe id="modalStrandVideo" src="" title="YouTube video player" frameborder="0" allowfullscreen></iframe>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#ratingModal">Interested? Enroll Now</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ratingModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Your Feedback Matters</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <p class="mb-3"><strong>Are you satisfied with your recommended strand?</strong></p>
                <div class="d-flex justify-content-center mb-4" id="starRating">
                    @for($i = 1; $i <= 5; $i++)
                        <span class="star fs-1 me-1" data-value="{{ $i }}" style="cursor:pointer; color: #ccc;">☆</span>
                    @endfor
                </div>
                <input type="hidden" id="selectedRating" value="0">
                <textarea class="form-control" id="feedbackMessage" rows="3" placeholder="How can we improve?"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary w-100" id="submitFeedback">Submit</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="thankYouModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center py-5">
            <div class="mb-3"><i class="fas fa-check-circle text-success fs-1"></i></div>
            <h4>Thank You!</h4>
            <p>Your feedback helps us improve. Redirecting to enrollment...</p>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    // 1. Strand Modal Logic with Video
    const strandModal = document.getElementById('strandInfoModal');
    strandModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        document.getElementById('modalStrandTitle').textContent = button.getAttribute('data-strand');
        document.getElementById('modalStrandFull').textContent = button.getAttribute('data-fullname');
        document.getElementById('modalStrandDescription').textContent = button.getAttribute('data-info');
        document.getElementById('modalStrandVideo').src = button.getAttribute('data-video');
    });

    // Stop video on close
    strandModal.addEventListener('hide.bs.modal', function () {
        document.getElementById('modalStrandVideo').src = "";
    });

    // 2. Star Rating Logic
    const stars = document.querySelectorAll('.star');
    const selectedRatingInput = document.getElementById('selectedRating');

    stars.forEach(star => {
        star.addEventListener('click', function() {
            const val = this.dataset.value;
            selectedRatingInput.value = val;
            stars.forEach((s, idx) => {
                s.textContent = (idx < val) ? '★' : '☆';
                s.style.color = (idx < val) ? '#ffc107' : '#ccc';
            });
        });
    });

    // 3. Submit Feedback
    document.getElementById('submitFeedback').addEventListener('click', function() {
        if(selectedRatingInput.value === '0') {
            alert('Please select a rating.');
            return;
        }
        bootstrap.Modal.getInstance(document.getElementById('ratingModal')).hide();
        new bootstrap.Modal(document.getElementById('thankYouModal')).show();
        setTimeout(() => { window.location.href = "{{ route('shs.enrollment') }}"; }, 2000);
    });
});
</script>
<style>
    .strand-item:hover {
        background-color: #f8fbff !important;
        border-color: #0d6efd !important;
        transform: translateY(-3px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }
    .max-w-4xl { max-width: 800px; }
    .star:hover { transform: scale(1.2); transition: 0.2s; }
</style>
@endpush