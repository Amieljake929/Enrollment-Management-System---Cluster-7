@extends('layouts.assessment')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-info text-white">
                    <h3>Welcome to Our Assessment Test!</h3>
                </div>
                <div class="card-body text-center">
                    <h4 class="mb-4">👋 Welcome, <strong>{{ $data['name'] }}</strong>!</h4>
                    <div class="alert alert-warning">
                        <h5>Ready? Here are a few reminders before you start the quiz:</h5>
                        <ul class="text-start">
                            <li><strong>This quiz contains 20 multiple-choice questions.</strong> You have 30 minutes to complete it.</li>
                            <li><strong>Please read each question carefully.</strong> Once you answer a question, you can't go back to change it.</li>
                            <li><strong>Make sure you're in a stable internet connection area</strong> to avoid any interruptions.</li>
                        </ul>
                        <p class="mt-3"><strong>Good luck!</strong> 🍀</p>
                    </div>
                    <a href="{{ route('college.quiz.show') }}" class="btn btn-primary btn-lg w-100">
                        Start the Quiz ➡️
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection