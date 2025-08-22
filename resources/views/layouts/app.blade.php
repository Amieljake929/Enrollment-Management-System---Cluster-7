<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }} 
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        <!-- Inactivity Modal -->
<div id="sessionTimeoutModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden justify-center items-center">
    <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm w-full text-center">
        <h2 class="text-lg font-bold mb-4">Session Expired</h2>
        <p class="mb-4">You have been inactive for 30 minutes. Please relogin to continue.</p>
        
        <form id="force-logout-form" method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" 
                class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                Relogin
            </button>
        </form>
    </div>
</div>


<!-- Inactivity Script -->
        <script>
            let inactivityTime = function () {
                let time;
                function resetTimer() {
                    clearTimeout(time);
                    time = setTimeout(showTimeoutModal, 30 * 60 * 1000); // 30 minutes
                }

                function showTimeoutModal() {
                    document.getElementById('sessionTimeoutModal').classList.remove('hidden');
                    document.getElementById('sessionTimeoutModal').classList.add('flex');
                }

                // DOM Events na considered as activity
                window.onload = resetTimer;
                document.onmousemove = resetTimer;
                document.onkeypress = resetTimer;
                document.onscroll = resetTimer;
                document.onclick = resetTimer;
            };

            inactivityTime();
        </script>

    </body>
</html>
