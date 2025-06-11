<x-app-layout>
<style>
    /* General page layout */
    x-app-layout {
        display: block;
        padding: 20px;
        background-color: #f4f4f9;
        font-family: Arial, sans-serif;
    }

    /* Header styling */
    h1 {
        font-size: 24px;
        color: #333;
        text-align: center;
        margin-bottom: 30px;
    }

    /* Search container */
    .search-container {
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 30px;
        max-width: 600px;
        margin: 0 auto;
    }

    /* Search form */
    .search-container form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    /* Search label and input styles */
    label {
        font-size: 14px;
        color: #555;
        font-weight: bold;
    }

    input[type="date"] {
        padding: 12px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 14px;
        width: 100%;
        background-color: #fafafa;
    }

    /* Button styles */
    button[type="submit"] {
        background-color: #007bff;
        color: white;
        padding: 12px 20px;
        border: none;
        border-radius: 4px;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        width: 100%;
    }

    button[type="submit"]:hover {
        background-color: #0056b3;
    }

    /* Table styling */
    .table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 30px;
    }

    .table th, .table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    .table th {
        background-color: #f8f9fa;
        font-size: 14px;
        color: #333;
    }

    .table td {
        font-size: 14px;
    }

    .table .btn {
        background-color: #007bff;
        color: white;
        padding: 8px 16px;
        text-decoration: none;
        border-radius: 4px;
        font-size: 14px;
        transition: background-color 0.3s ease;
    }

    .table .btn:hover {
        background-color: #0056b3;
    }

    /* Responsive styling */
    @media screen and (max-width: 768px) {
        .search-container {
            padding: 15px;
            margin: 10px;
        }

        .table th, .table td {
            padding: 10px;
        }

        button[type="submit"] {
            padding: 10px 15px;
        }

        .table .btn {
            padding: 6px 12px;
        }
    }

</style>
    <h1>Filter Interventions</h1>

    <div class="search-container">
        <form method="GET" action="{{ route('filterInterventions') }}">
            <label for="filter_date">Search by Date:</label>
            <input type="date" id="filter_date" name="filter_date">
            <button type="submit" class="btn">Search</button>
        </form>
    </div>

        <table class="table">
            <thead>
            <tr>
                <th>Nom</th>
                <th>Fonction</th>
                <th>Form type</th>
                <th>Due Date</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($interventions as $intervention)
                <tr>
                    <td>{{ $intervention->name }}</td>
                    <td>{{ $intervention->fonction }}</td>
                    <td>{{ $intervention->form_type }}</td>
                    <td>{{ $intervention->due_date }}</td>
                    <td>
                        <a href="{{ route('interventions.show', $intervention->id) }}" class="btn btn-primary">View</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

{{--    @else--}}
{{--        <p>No interventions found for the selected date.</p>--}}
{{--    @endif--}}
</x-app-layout>
