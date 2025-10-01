@extends('layouts.assessment')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0 rounded-4" style="background: #f8f9fa;">
                <div class="card-header bg-white border-bottom-0 p-4">
                    <h4 class="text-primary fw-bold mb-0">📝 College Assessment Quiz</h4>
                    <small class="text-muted d-block mt-1">
                        Based on your interests: 
                        @foreach(session('selected_interests', []) as $interest)
                            <span class="badge bg-light text-dark me-1">{{ $interest }}</span>
                        @endforeach
                    </small>
                </div>

                <div class="card-body p-4">
                    <form id="quizForm" method="POST" action="{{ route('college.quiz.submit') }}">
                        @csrf

                        <!-- Progress Bar -->
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-primary fw-bold"><i class="fas fa-lightbulb me-2"></i> Career Assessment</span>
                                <span class="badge bg-primary" id="questionCounter">Question 1 of {{ count($questions) }}</span>
                            </div>
                            <div class="progress" style="height: 6px; background-color: #e9ecef;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: 0%;" id="progressBar"></div>
                            </div>
                            <div class="d-flex justify-content-between mt-1">
                                <small class="text-muted">Start</small>
                                <small class="text-muted" id="progressText">0% Complete</small>
                            </div>
                        </div>

                        <!-- Questions Container -->
                        <div id="questionsContainer">
                            @php
                                $totalQuestions = count($questions);
                                $currentQuestionIndex = 0;
                            @endphp

                            @foreach($groupedQuestions as $course => $courseQuestions)
                                @if($course !== 'TIE_BREAKER')
                                    @foreach($courseQuestions as $q)
                                        @if($q['type'] === 'regular')
                                            <div class="question-card mb-4 p-4 bg-white border rounded shadow-sm" data-question-id="{{ $q['id'] }}" style="display: {{ $currentQuestionIndex == 0 ? 'block' : 'none' }};">
                                                <h5 class="mb-3">{{ $q['question'] }}</h5> <!-- ❗️ WALANG NUMBER NA DITO -->
                                                <div class="row g-3">
                                                    <div class="col-12">
                                                        <div class="form-check p-3 border rounded d-flex align-items-center" style="cursor: pointer;">
                                                            <input class="form-check-input me-3" type="radio" name="answers[{{ $q['id'] }}]" value="very_interested" id="q{{ $q['id'] }}_5" required>
                                                            <label class="form-check-label flex-grow-1" for="q{{ $q['id'] }}_5">
                                                                Very Interested 
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check p-3 border rounded d-flex align-items-center" style="cursor: pointer;">
                                                            <input class="form-check-input me-3" type="radio" name="answers[{{ $q['id'] }}]" value="slightly_interested" id="q{{ $q['id'] }}_4">
                                                            <label class="form-check-label flex-grow-1" for="q{{ $q['id'] }}_4">
                                                                Slightly Interested 
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check p-3 border rounded d-flex align-items-center" style="cursor: pointer;">
                                                            <input class="form-check-input me-3" type="radio" name="answers[{{ $q['id'] }}]" value="interested" id="q{{ $q['id'] }}_3">
                                                            <label class="form-check-label flex-grow-1" for="q{{ $q['id'] }}_3">
                                                                Interested 
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check p-3 border rounded d-flex align-items-center" style="cursor: pointer;">
                                                            <input class="form-check-input me-3" type="radio" name="answers[{{ $q['id'] }}]" value="not_interested" id="q{{ $q['id'] }}_2">
                                                            <label class="form-check-label flex-grow-1" for="q{{ $q['id'] }}_2">
                                                                Not Interested 
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @php $currentQuestionIndex++; @endphp
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach

                            {{-- TIE BREAKER QUESTIONS --}}
                            @foreach($questions as $q)
                                @if($q['type'] === 'tie_breaker')
                                    <div class="question-card mb-4 p-4 bg-white border rounded shadow-sm" data-question-id="{{ $q['id'] }}" style="display: none;">
                                        <h5 class="mb-3 text-dark">Tie Breaker: {{ $q['question'] }}</h5>
                                        <div class="row g-3">
                                            @foreach($q['options'] as $opt)
                                                <div class="col-12">
                                                    <div class="form-check p-3 border rounded d-flex align-items-center" style="cursor: pointer;">
                                                        <input class="form-check-input me-3" type="radio" name="answers[{{ $q['id'] }}]" value="{{ $opt['course'] }}" id="tb{{ $q['id'] }}_{{ $opt['label'] }}" required>
                                                        <label class="form-check-label flex-grow-1" for="tb{{ $q['id'] }}_{{ $opt['label'] }}">
                                                            <strong>{{ $opt['label'] }}.</strong> {{ $opt['text'] }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @php $currentQuestionIndex++; @endphp
                                @endif
                            @endforeach
                        </div>

                        <!-- Navigation Buttons -->
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-outline-primary" id="prevBtn" disabled>
                                <i class="fas fa-arrow-left me-2"></i> Previous
                            </button>
                            <button type="submit" class="btn btn-success px-4" id="submitBtn" style="display: none;">
                                Submit Quiz 🚀
                            </button>
                            <button type="button" class="btn btn-primary" id="nextBtn">
                                Next <i class="fas fa-arrow-right ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Navigation -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const questions = document.querySelectorAll('.question-card');
        const totalQuestions = questions.length;
        let currentQuestionIndex = 0;

        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const submitBtn = document.getElementById('submitBtn');
        const questionCounter = document.getElementById('questionCounter');
        const progressBar = document.getElementById('progressBar');
        const progressText = document.getElementById('progressText');

        function updateProgress() {
            const percent = Math.round((currentQuestionIndex / totalQuestions) * 100);
            progressBar.style.width = percent + '%';
            progressText.textContent = percent + '% Complete';
            questionCounter.textContent = `Question ${currentQuestionIndex + 1} of ${totalQuestions}`;
            
            if (currentQuestionIndex === 0) {
                prevBtn.disabled = true;
            } else {
                prevBtn.disabled = false;
            }

            if (currentQuestionIndex === totalQuestions - 1) {
                nextBtn.style.display = 'none';
                submitBtn.style.display = 'inline-block';
            } else {
                nextBtn.style.display = 'inline-block';
                submitBtn.style.display = 'none';
            }
        }

        function showQuestion(index) {
            questions.forEach((q, i) => {
                q.style.display = i === index ? 'block' : 'none';
            });
            currentQuestionIndex = index;
            updateProgress();
        }

        prevBtn.addEventListener('click', () => {
            if (currentQuestionIndex > 0) {
                showQuestion(currentQuestionIndex - 1);
            }
        });

        nextBtn.addEventListener('click', () => {
            // Validate current question
            const currentQ = questions[currentQuestionIndex];
            const radios = currentQ.querySelectorAll('input[type="radio"]');
            let selected = false;
            radios.forEach(r => {
                if (r.checked) selected = true;
            });

            if (!selected) {
                alert("Please select an answer before proceeding.");
                return;
            }

            if (currentQuestionIndex < totalQuestions - 1) {
                showQuestion(currentQuestionIndex + 1);
            }
        });

        // Initialize
        showQuestion(0);
    });
</script>

@endsection