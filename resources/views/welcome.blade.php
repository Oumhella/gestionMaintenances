<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

        <!-- Styles -->
        <style>
            body {
                background-color: #f3f4f6; /* Tailwind's gray-100 */
                font-family: 'Figtree', sans-serif;
                min-height: 100vh;
                display: flex;
                justify-content: center;
                align-items: center;
                margin: 0;
            }

            .card {
                background-color: white;
                padding: 2rem; /* p-8 */
                border-radius: 0.5rem; /* rounded-lg */
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); /* shadow-xl */
                max-width: 600px;
                width: 100%;
                text-align: center;
            }

            h1 {
                font-size: 1.875rem; /* text-3xl */
                font-weight: 600;
                margin-bottom: 1rem;
                color: #1f2937; /* text-gray-800 */
            }

            p {
                font-size: 1rem; /* text-base */
                color: #4b5563; /* text-gray-600 */
            }

            a.button {
                display: inline-block;
                margin-top: 1.5rem;
                padding: 0.5rem 1.5rem;
                background-color: #2563eb; /* blue-600 */
                color: white;
                border-radius: 0.375rem;
                text-decoration: none;
                font-weight: 500;
                transition: background-color 0.3s ease;
            }

            a.button:hover {
                background-color: #1e40af; /* blue-800 */
            }
        </style>

    </head>
    <body>
{{--        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-red-500 selection:text-white">--}}
<div class="card">
            @if (Route::has('login'))
                <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
{{--                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>--}}
                        <a href="{{ url('/dashboard') }}" class="button">Go to Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

        </div>
    </body>
</html>
