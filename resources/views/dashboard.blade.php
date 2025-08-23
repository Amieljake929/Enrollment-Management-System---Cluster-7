@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">

    {{-- Header --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-800">Enrollment Dashboard</h1>
        <p class="text-gray-600">Welcome back, {{ Auth::user()->name }}! Here's an overview of the system.</p>
    </div>

    

</div>
@endsection