<!-- resources/views/website/enrollment_success.blade.php -->
@extends('website.layout')

@section('title', 'Enrollment Success')

@section('content')
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8 text-center">
      <i class="fas fa-check-circle text-success" style="font-size: 5rem;"></i>
      <h2 class="mt-4">Enrollment Submitted Successfully!</h2>
      <p class="lead">Thank you for enrolling at Bestlink College of the Philippines. We will review your documents and send updates via email.</p>
      <a href="{{ route('one') }}" class="btn btn-primary mt-3">Back to Homepage</a>
    </div>
  </div>
</div>
@endsection