<x-app-layout>
    <style>
        table{
            width: 100%;
        }
    </style>
    <h1>Uploaded Images</h1>

    <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
        <thead>
        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
            <th class="py-3 px-6 text-left">User ID</th>
            <th class="py-3 px-6 text-left">Form Type</th>
            <th class="py-3 px-6 text-left">Task ID</th>
            <th class="py-3 px-6 text-left">Image</th>
            <th class="py-3 px-6 text-left">Uploaded At</th>
        </tr>
        </thead>
        <tbody class="text-gray-600 text-sm font-light">
        @foreach($images as $image)
            <tr class="border-b border-gray-200 hover:bg-gray-100">
                <td class="py-3 px-6 text-left">{{ $image->user_id }}</td>
                <td class="py-3 px-6 text-left">{{ $image->form_type }}</td>
{{--                <td class="py-3 px-6 text-left">{{ $image->task_id ?? 'N/A' }}</td>--}}
                <td class="py-3 px-6 text-left">{{ $image->getTaskName() }}</td> <!-- Display task name -->
                <td class="py-3 px-6">
                    <img src="{{ asset('images/images/' . $image->image) }}" alt="Image" style="max-width: 100px;">


                </td>
                <td class="py-3 px-6 text-left">{{ $image->created_at->format('Y-m-d') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

</x-app-layout>
