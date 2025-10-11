@extends('layouts.assessment')

@section('content')
<div class="container-fluid py-5">
    <div class="max-w-4xl mx-auto">
        <!-- Header -->
        <div class="text-center mb-6">
            <h1 class="h2 fw-bold text-primary">College Course Quiz Result</h1>
            <p class="text-muted">Based on your interests, strengths, and preferences</p>
        </div>

        @if(isset($recommendations) && count($recommendations) > 0)
            <!-- Final Recommendations -->
            <div class="card shadow-sm border-0 mb-6">
                <div class="card-body p-5">
                    <h2 class="h4 fw-semibold mb-4 text-success">Your Top 3 Recommended Courses</h2>

                    @foreach($recommendations as $idx => $rec)
                        <div class="mb-4 p-3 border rounded @if($rec['is_top']) bg-light border-primary @endif">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h3 class="h5 mb-1">{{ $rec['course'] }}</h3>
                                    <p class="text-muted mb-2">{{ $rec['description'] }}</p>
                                    <small class="text-secondary">Interest Score: <strong>{{ $rec['local_score'] }}</strong></small>
                                </div>
                                <div class="text-end">
                                    @php
                                        $suffix = match($idx) {
                                            0 => 'st',
                                            1 => 'nd',
                                            2 => 'rd',
                                            default => 'th'
                                        };
                                        $bgColor = match($idx) {
                                            0 => 'primary',
                                            1 => 'info',
                                            2 => 'secondary',
                                            default => 'secondary'
                                        };
                                    @endphp
                                    <div class="badge bg-{{ $bgColor }} px-3 py-2">
                                        {{ $idx + 1 }}{{ $suffix }}
                                    </div>
                                    <div class="mt-1">
                                        <small>Confidence: <strong>{{ $rec['confidence'] }}%</strong></small>
                                    </div>
                                </div>
                            </div>

                            <!-- Confidence Meter -->
                            <div class="mt-3">
                                <div class="d-flex justify-content-between mb-1">
                                    <small>Confidence Level</small>
                                    <small><strong>{{ number_format($rec['confidence'], 2) }}%</strong></small>
                                </div>
                                <div class="progress" style="height: 20px;">
                                    <div class="progress-bar
                                        @if($rec['confidence'] >= 90) bg-success
                                        @elseif($rec['confidence'] >= 80) bg-info
                                        @elseif($rec['confidence'] >= 70) bg-warning
                                        @else bg-danger
                                        @endif"
                                        role="progressbar"
                                        style="width: {{ $rec['confidence'] }}%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Interest Profile Table -->
            <div class="card shadow-sm border-0 mb-6">
                <div class="card-header bg-primary text-white">
                    <h4 class="h5 mb-0">Your Interest Profile</h4>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-3">
                        Scores based on your responses (3 = Very Interested, 2 = Interested, 1 = Slightly Interested, 0 = Not Interested)
                    </p>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover align-middle">
                            <thead class="table-light">
                                <tr>
                                    <th>Course Code</th>
                                    <th>Description</th>
                                    <th class="text-end">Score</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($localScores as $course => $score)
                                    @if($score > 0)
                                        <tr @if($loop->first) class="table-primary fw-bold" @endif>
                                            <td><strong>{{ $course }}</strong></td>
                                            <td>{{ $allCourses[$course] ?? 'N/A' }}</td>
                                            <td class="text-end">
                                                <span class="badge bg-secondary">{{ round($score, 2) }}</span>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Why This Recommendation? -->
            <div class="card shadow-sm border-0 mb-6">
                <div class="card-header bg-info text-white">
                    <h4 class="h5 mb-0">Why This Recommendation?</h4>
                </div>
                <div class="card-body">
                    <p class="lead text-dark">
                        {{ $narrative }}
                    </p>

                    <div class="alert alert-light border mt-4">
                        <h6 class="mb-1">AI Analysis Summary</h6>
                        <p class="mb-0 small">
                            <strong>Top Match:</strong> {{ $recommendations[0]['course'] }} |
                            <strong>Confidence:</strong> {{ number_format($recommendations[0]['confidence'], 2) }}% |
                            <strong>Method:</strong> Hugging Face NLP + weighted interest scoring
                        </p>
                    </div>
                </div>
            </div>

        @else
            <!-- Fallback Message -->
            <div class="text-center p-5 bg-light border rounded mb-6">
                <h3 class="text-danger">No Recommendation Available</h3>
                <p class="text-muted">We couldn't determine a suitable course based on your answers.</p>
                <p>Please ensure all questions were answered completely.</p>
            </div>
        @endif

        <!-- Disclaimer -->
<div class="mt-6 p-4 rounded-3 border bg-white shadow-sm">
    <div class="d-flex align-items-start mb-2">
        <i class="fas fa-exclamation-circle text-warning fs-5 mt-1 me-2"></i>
        <h6 class="mb-0 text-dark fw-bold">Disclaimer</h6>
    </div>
    <p class="text-muted mb-0 small">
        This result was generated by AI based on your answers. It is not 100% accurate and should only be used as a guide. The final decision about your strand is still in your hands. Always consider your passion, interests, and personal goals before making a choice. If you’re unsure, it’s best to talk to your guidance counselor, teachers, or parents for proper advice.
    </p>
    <p class="text-muted mb-0 small mt-2">
        This tool is here to help you explore options, but it does not replace professional guidance. We are not responsible if you choose a strand based only on this result and later find it difficult. Use this as one of your tools in making an informed decision—not the only basis.
    </p>
</div>

        <!-- Action Buttons -->
        <div class="text-center mt-4 d-flex justify-content-center gap-3 flex-wrap">
            <a href="{{ route('college.welcome') }}" class="btn btn-primary btn-lg px-5">
                Take Quiz Again
            </a>
            <button type="button" class="btn btn-success btn-lg px-5" data-bs-toggle="modal" data-bs-target="#ratingModal">
                Enroll Now
            </button>
        </div>

       
    </div>
</div>

<!-- Rating Modal -->
<div class="modal fade" id="ratingModal" tabindex="-1" aria-labelledby="ratingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ratingModalLabel">Your Feedback Matters</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p class="mb-3"><strong>Are you satisfied with your recommended course/strand?</strong></p>

                <!-- Star Rating -->
                <div class="d-flex justify-content-center mb-4" id="starRating">
                    @for($i = 1; $i <= 5; $i++)
                        <span class="star fs-1 me-1" data-value="{{ $i }}">☆</span>
                    @endfor
                </div>
                <input type="hidden" id="selectedRating" value="0">

                <!-- Message Box -->
                <div class="mb-3">
                    <label for="feedbackMessage" class="form-label"><strong>Where can we improve?</strong></label>
                    <textarea class="form-control" id="feedbackMessage" rows="3" placeholder="Your suggestions or comments..."></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="submitFeedback">Submit</button>
            </div>
        </div>
    </div>
</div>

<!-- Thank You Modal -->
<div class="modal fade" id="thankYouModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center py-5">
                <h4 class="mb-3">Thank You!</h4>
                <p>Your feedback helps us improve.</p>
            </div>
        </div>
    </div>
</div>
@endsection

<!-- Custom Styles -->
<style>
    .table th, .table td {
        vertical-align: middle;
    }
    .progress-bar {
        transition: width 0.4s ease-in-out;
    }
    .card {
        border-radius: 12px;
        overflow: hidden;
    }
    .card-header {
        border-top-left-radius: 12px;
        border-top-right-radius: 12px;
    }
    .badge {
        font-size: 0.8em;
        font-weight: bold;
    }
    .max-w-4xl {
        max-width: 768px;
    }
    .mx-auto {
        margin-left: auto;
        margin-right: auto;
    }

    /* Star Rating */
    .star {
        cursor: pointer;
        color: #f5e400;
        transition: color 0.2s;
    }
    .star.active, .star:hover {
        color: #ffc107;
    }
    .star.hover-active {
        color: #ffc107;
    }
</style>

<!-- JavaScript for Star Rating & Modal Flow -->
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const stars = document.querySelectorAll('.star');
    const selectedRatingInput = document.getElementById('selectedRating');
    const submitBtn = document.getElementById('submitFeedback');
    const thankYouModal = new bootstrap.Modal(document.getElementById('thankYouModal'));

    // Star hover & selection
    stars.forEach(star => {
        star.addEventListener('click', function () {
            const value = this.getAttribute('data-value');
            selectedRatingInput.value = value;

            // Reset all
            stars.forEach(s => s.textContent = '☆');
            // Fill selected
            for (let i = 0; i < value; i++) {
                stars[i].textContent = '★';
            }
        });

        star.addEventListener('mouseover', function () {
            const value = this.getAttribute('data-value');
            stars.forEach((s, idx) => {
                s.textContent = (idx < value) ? '★' : '☆';
            });
        });

        star.addEventListener('mouseout', function () {
            const currentRating = selectedRatingInput.value;
            stars.forEach((s, idx) => {
                s.textContent = (idx < currentRating) ? '★' : '☆';
            });
        });
    });

    // Submit feedback
    submitBtn.addEventListener('click', function () {
        const rating = selectedRatingInput.value;
        const message = document.getElementById('feedbackMessage').value.trim();

        if (rating === '0') {
            alert('Please select a rating.');
            return;
        }

        // Close rating modal
        bootstrap.Modal.getInstance(document.getElementById('ratingModal')).hide();

        // Show thank you modal
        thankYouModal.show();

        // After 1.5 seconds, redirect
        setTimeout(() => {
            thankYouModal.hide();
            window.location.href = "{{ route('two') }}"; // Make sure 'two' route exists
        }, 1500);
    });
});
</script>
@endpush