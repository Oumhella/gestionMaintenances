<x-app-layout>
    <style>
        /* Include CSS styles here */
    </style>

    <h1>Intervention Overview</h1>

    <div class="search-container">
        <form method="GET" action="{{ route('filterInterventions') }}">
            <label for="filter_date">Search by Date:</label>
            <input type="date" id="filter_date" name="filter_date">
            <button type="submit" class="btn">Search</button>
        </form>
    </div>

    <table>
        <thead>
        <tr>
            <th>Name</th>
            <th>Function</th>
            <th>Date</th>
            <th>Form Type</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($interventions as $intervention)
            <tr>
                <td>{{ $intervention->name }}</td>
                <td>{{ $intervention->fonction }}</td>
                <td>{{ $intervention->due_date }}</td>
                <td>{{ ucfirst($intervention->form_type) }}</td>
                <td>
                    <a href="{{ route('interventions.show', ['id' => $intervention->id]) }}" class="btn">View</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-app-layout>
