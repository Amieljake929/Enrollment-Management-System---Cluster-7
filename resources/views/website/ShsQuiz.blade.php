@extends('layouts.web')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <!-- Header -->
        <div class="col-12 text-center mb-4">
            <h1 class="h3 fw-bold">SHS Strand Quiz Assessment</h1>
            <p class="text-muted">Rate how interested you are in each activity.</p>
        </div>

        <!-- Left: Question Pane -->
        <div class="col-12 col-lg-7 mb-4 mb-lg-0">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <form id="quizForm" action="{{ route('quiz.submit') }}" method="POST">
                        @csrf

                        @php
                            $questions = json_decode(file_get_contents(public_path('data/quiz_questions.json')), true);
                        @endphp

                        <input type="hidden" id="currentQuestion" value="1">

                        @foreach ($questions as $q)
                            <div class="question-container p-4 mb-4 bg-light rounded-3 border"
                                 id="question-{{ $q['id'] }}"
                                 style="{{ $q['id'] == 1 ? 'display: block;' : 'display: none;' }}">
                                <h5 class="fw-semibold mb-3 text-primary">
                                    {{ $q['id'] }}. {{ $q['question'] }}
                                </h5>
                                <div class="mt-3">
                                    @foreach (['very_interested' => 'Very Interested', 'interested' => 'Interested', 'slightly_interested' => 'Slightly Interested', 'not_interested' => 'Not Interested'] as $value => $label)
                                        <div class="form-check mb-2">
                                            <input class="form-check-input"
                                                   type="radio"
                                                   name="answers[{{ $q['id'] }}]"
                                                   value="{{ $value }}"
                                                   id="q{{ $q['id'] }}-{{ $value }}"
                                                   required>
                                            <label class="form-check-label" for="q{{ $q['id'] }}-{{ $value }}">
                                                <strong>{{ $label }}</strong>
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach

                        <!-- Navigation Buttons -->
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-outline-secondary" id="prevBtn">Previous</button>
                            <button type="button" class="btn btn-outline-secondary" id="nextBtn">Next</button>
                            <button type="submit" class="btn btn-success">Submit Quiz</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Right: Navigation Pane -->
        <div class="col-12 col-lg-5">
            <div class="card shadow-sm border-0 h-100">
                <div class="card-body">
                    <h5 class="card-title fw-bold mb-3">Quiz Progress</h5>
                    <div id="quizNavigator" class="d-flex flex-wrap gap-2">
                        @for ($i = 1; $i <= 50; $i++)
                            <button type="button"
                                    class="btn btn-outline-gray btn-sm question-btn"
                                    data-question="{{ $i }}"
                                    style="width: 48px; height: 48px; font-weight: 500;">
                                {{ $i }}
                            </button>
                        @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom Styles -->
<style>
    .btn-outline-gray {
        color: #495057;
        border-color: #ced4da;
    }
    .btn-outline-gray:hover {
        background-color: #f8f9fa;
        border-color: #adb5bd;
    }
    .btn-answered {
        background-color: #28a745 !important;
        color: white !important;
        border-color: #28a745 !important;
    }
    .btn-current {
        background-color: #0d6efd !important;
        color: white !important;
        border-color: #0d6efd !important;
        transform: scale(1.05);
        box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.25);
    }
</style>

<!-- JavaScript for Navigation & Tracking -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const totalQuestions = 50;
        let currentQuestion = 1;

        const showQuestion = (num) => {
            document.querySelectorAll('.question-container').forEach(q => {
                q.style.display = 'none';
            });
            const questionEl = document.getElementById(`question-${num}`);
            if (questionEl) questionEl.style.display = 'block';
            document.getElementById('currentQuestion').value = num;
            updateNavigator();
        };

        const updateNavigator = () => {
            document.querySelectorAll('.question-btn').forEach(btn => {
                const qNum = parseInt(btn.getAttribute('data-question'));
                btn.classList.remove('btn-answered', 'btn-current');

                if (qNum === currentQuestion) {
                    btn.classList.add('btn-current');
                }

                const selected = document.querySelector(`input[name="answers[${qNum}]"]:checked`);
                if (selected && qNum !== currentQuestion) {
                    btn.classList.add('btn-answered');
                }
            });
        };

        document.querySelectorAll('.question-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                currentQuestion = parseInt(this.getAttribute('data-question'));
                showQuestion(currentQuestion);
            });
        });

        document.getElementById('prevBtn').addEventListener('click', () => {
            if (currentQuestion > 1) {
                currentQuestion--;
                showQuestion(currentQuestion);
            }
        });

        document.getElementById('nextBtn').addEventListener('click', () => {
            if (currentQuestion < totalQuestions) {
                currentQuestion++;
                showQuestion(currentQuestion);
            }
        });

        document.querySelectorAll('input[type="radio"]').forEach(radio => {
            radio.addEventListener('change', updateNavigator);
        });

        showQuestion(currentQuestion);

        document.getElementById('quizForm').addEventListener('submit', function (e) {
            let unanswered = [];
            for (let i = 1; i <= totalQuestions; i++) {
                if (!document.querySelector(`input[name="answers[${i}]"]:checked`)) {
                    unanswered.push(i);
                }
            }
            if (unanswered.length > 0) {
                e.preventDefault();
                alert(`Please answer question(s): ${unanswered.slice(0, 5).join(', ')}${unanswered.length > 5 ? '...' : ''}`);
            }
        });
    });
</script>

@endsection