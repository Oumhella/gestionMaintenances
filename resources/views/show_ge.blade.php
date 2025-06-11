<x-app-layout>

{{--@section('content')--}}
<style>
    /* Base styling */
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f3f4f6;
        color: #333;
        margin: 0;
        padding: 0;
    }

    /* Container styling */
    .container {
        max-width: 1000px;
        margin: 30px auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    /* Header styling */
    h1 {
        color: #444;
        text-align: center;
        font-size: 24px;
        margin-bottom: 25px;
    }

    /* Card component */
    .card {
        background-color: #fdfdfd;
        border: 1px solid #ddd;
        border-radius: 8px;
        margin-bottom: 20px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    }

    .card-header {
        background-color: #854093;
        color: #fff;
        font-size: 18px;
        font-weight: bold;
        padding: 15px;
        border-top-left-radius: 8px;
        border-top-right-radius: 8px;
    }

    .card-body {
        padding: 15px;
    }

    /* Text formatting for common data */
    .card-body p {
        font-size: 16px;
        margin: 8px 0;
    }

    .card-body strong {
        color: #555;
    }

    /* Table styling */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 15px;
        font-size: 16px;
    }

    th, td {
        padding: 10px 12px;
        border: 1px solid #ddd;
        text-align: center;
    }

    th {
        background-color: #854093;
        color: #fff;
        font-weight: bold;
    }

    td {
        background-color: #f9f9f9;
    }

    /* Alternate row color and hover effect */
    tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }

    tbody tr:hover {
        background-color: #eaf4ff;
    }

    /* Image styling */
    img {
        border-radius: 4px;
        max-width: 100px;
        max-height: 100px;
        object-fit: cover;
    }
    #in{
        border: 1px solid #ddd;
        background-color: #f2f2f2;
        text-align: center;
    }
    #tst{
        padding-top: 20px;
        padding-right: 300px;
        padding-left: 20px;
    }
</style>

<div class="container">
    <h1>FICHE D'INTERVENTION PRÉVENTIVE (SUR SITE)</h1>

    <!-- Display common data -->
    <div class="card mb-3">
        <div class="card-header">les informations de l'intervenant :</div>
        <div class="card-body">
            <p><strong>Intervenant:</strong> {{ $commonData->name }}</p>
            <p><strong>Fonction:</strong> {{ $commonData->fonction }}</p>
            <p><strong>Date:</strong> {{ $commonData->due_date }}</p>
            {{--                <p><strong>Form Type:</strong> {{ $commonData->form_type }}</p>--}}


        </div>
    </div>

    <!-- Display specific form data (Coffrets Informatique example) -->
    @if($commonData->form_type === 'ge' && $commonData->geData->isNotEmpty())
        <div class="card">
            <div class="card-header">Système d'affichage GE - Parcelle O Details</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Tâche</th>
                        <th>Status</th>
                        <th>Description</th>
                                                    <th>Image</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($commonData->geData as $task)
                        <tr>
                            <td>{{ $task->task->name }}</td>
                            <td>{{ $task->task_status }}</td>
                            <td>{{ $task->description }}</td>
                            <td>
                                @if ($task->image && file_exists(public_path('images/' . $task->image)))
                                    <img src="{{ asset('images/' . $task->image) }}" alt="Task Image" class="task-image">
                                @else
                                    pas d'image
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div id="in">
                    @if($commonData->geData->isNotEmpty())
                        <p ><strong id="tst">Mesure de l'alimentation 220VAC: </strong> {{ $commonData->geData->first()->input_220VAC }}</p>
                    @endif
                </div>
            </div>
        </div>
    @endif
</div>
{{--@endsection--}}
</x-app-layout>
