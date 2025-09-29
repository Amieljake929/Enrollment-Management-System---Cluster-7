@extends('layouts.web')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h4>📝 SHS Strand Quiz Assessment</h4>
                    <small>Based on your interests: 
                        @foreach(session('shs_selected_interests', []) as $interest)
                            <span class="badge bg-light text-dark">{{ $interest }}</span>
                        @endforeach
                    </small>
                </div>
                <div class="card-body">
                    <form id="quizForm" method="POST" action="{{ route('quiz.submit') }}">
                        @csrf

                        @foreach($groupedQuestions as $strand => $strandQuestions)
                            @if($strand !== 'TIE_BREAKER')
                                <div class="mb-5 p-3 border rounded bg-light">
                                    <h5 class="text-primary">{{ $allStrands[$strand] ?? $strand }}</h5>
                                    <hr>
                                    @foreach($strandQuestions as $q)
                                        @if($q['type'] === 'regular')
                                            <div class="mb-4">
                                                <p><strong>{{ $q['id'] }}. {{ $q['question'] }}</strong></p>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="answers[{{ $q['id'] }}]" value="very_interested" id="q{{ $q['id'] }}_5" required>
                                                    <label class="form-check-label" for="q{{ $q['id'] }}_5">Very Interested (5)</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="answers[{{ $q['id'] }}]" value="slightly_interested" id="q{{ $q['id'] }}_4">
                                                    <label class="form-check-label" for="q{{ $q['id'] }}_4">Slightly Interested (4)</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="answers[{{ $q['id'] }}]" value="interested" id="q{{ $q['id'] }}_3">
                                                    <label class="form-check-label" for="q{{ $q['id'] }}_3">Interested (3)</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="answers[{{ $q['id'] }}]" value="not_interested" id="q{{ $q['id'] }}_2">
                                                    <label class="form-check-label" for="q{{ $q['id'] }}_2">Not Interested (2)</label>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            @endif
                        @endforeach

                        {{-- TIE BREAKER QUESTIONS --}}
                        @foreach($questions as $q)
                            @if($q['type'] === 'tie_breaker')
                                <div class="mb-5 p-3 border rounded bg-warning">
                                    <h5 class="text-dark">Tie Breaker: {{ $q['question'] }}</h5>
                                    <hr>
                                    @foreach($q['options'] as $opt)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="answers[{{ $q['id'] }}]" value="{{ $opt['strand'] }}" id="tb{{ $q['id'] }}_{{ $opt['label'] }}" required>
                                            <label class="form-check-label" for="tb{{ $q['id'] }}_{{ $opt['label'] }}">
                                                <strong>{{ $opt['label'] }}.</strong> {{ $opt['text'] }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        @endforeach

                        <button type="submit" class="btn btn-success w-100 btn-lg">Submit Quiz 🚀</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection