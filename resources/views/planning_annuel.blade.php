<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Planning Annuel</h2>
    </x-slot>

    <div class="py-10 px-6 bg-gray-100 min-h-screen">
        <!-- Calendar -->
        <div id="calendar" class="bg-white rounded-xl shadow p-4 max-w-6xl mx-auto"></div>

        <!-- Modal Form -->
        <div id="event-form" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <form id="calendarEventForm" class="bg-white rounded-xl shadow-xl p-6 w-full max-w-lg space-y-4">
                <input type="hidden" id="event-id" name="id">

                <div>
                    <label class="block text-sm font-medium text-gray-700">Title:</label>
                    <input type="text" id="event-title" name="title" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Start:</label>
                    <input type="datetime-local" id="event-start" name="start" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">End:</label>
                    <input type="datetime-local" id="event-end" name="end" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                </div>

                <div class="flex justify-end space-x-4 pt-4">
                    <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">Save</button>
                    <button type="button" id="closeForm" class="bg-gray-400 text-white px-4 py-2 rounded-md hover:bg-gray-500">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
