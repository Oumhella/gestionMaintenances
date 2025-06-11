
<x-app-layout>
    <div class="container">
        <div class="row">

            <div class="col-md-9">
                <!-- Header Section -->
                <div class="header">
                    <h1 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __('Dashboard') }}
                    </h1>
                </div>
{{--                <div class="col-md-3">--}}
{{--                    @include('partials.menu-dashboard') <!-- Including the menu -->--}}
{{--                </div>--}}
                <!-- Main Content -->
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <p>Welcome, {{ Auth::user()->name }}!</p> <!-- Display the username -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
