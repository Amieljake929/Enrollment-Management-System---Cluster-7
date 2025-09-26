@extends('layouts.college')

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
                                        // Determine rank suffix
                                        $suffix = match($idx) {
                                            0 => 'st',
                                            1 => 'nd',
                                            2 => 'rd',
                                            default => 'th'
                                        };
                                        // Determine badge color
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

        <!-- Action Button -->
        <div class="text-center mt-4">
            <a href="{{ route('college.welcome') }}" class="btn btn-primary btn-lg px-5">
                Take Quiz Again
            </a>
        </div>
    </div>
</div>
@endsection

<!-- Optional Custom Styles -->
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
</style>