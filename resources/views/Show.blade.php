<x-app-layout>

{{--@section('content')--}}
<style>
    /* Base styling */
    /* Base styling for the app layout */
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f3f4f6;
        color: #333;
        margin: 0;
        padding: 0;
    }

    /* Layout Container */
    .container {
        max-width: 1200px;
        margin: 30px auto;
        padding: 20px;
        background-color: #fff;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    /* Header styling inside app-layout */
    .header {
        background-color: #854093;
        color: white;
        padding: 20px;
        font-size: 26px;
        text-align: center;
        border-radius: 8px;
        margin-bottom: 20px;
    }

    /* Card Component */
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

    /* Task Image */
    .task-image {
        width: 550px;
        height: auto;
        object-fit: contain;
    }

    /* Specific styles for content inside cards */
    .card-body p {
        font-size: 16px;
        margin: 8px 0;
    }

    .card-body strong {
        color: #555;
    }

    /* Custom Input for Forms */
    input[type="text"],
    input[type="date"],
    textarea {
        width: 100%;
        padding: 10px;
        margin: 8px 0;
        border: 1px solid #ddd;
        border-radius: 8px;
        background-color: #f9f9f9;
    }

    input[type="submit"] {
        padding: 10px 20px;
        background-color: #854093;
        color: white;
        border: none;
        border-radius: 8px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #6d3360;
    }

    /* Media Queries for Responsiveness */
    @media screen and (max-width: 768px) {
        .container {
            padding: 15px;
        }

        .header {
            font-size: 22px;
        }

        .card-header {
            font-size: 16px;
        }

        .card-body {
            padding: 10px;
        }

        table {
            font-size: 14px;
        }

        .task-image {
            width: 100%;
            height: auto;
        }
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
        @if($commonData->form_type === 'coffrets_informatique' && $commonData->coffretsInformatiqueData->isNotEmpty())
            <div class="card">
                <div class="card-header">Coffrets Informatique Details</div>
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
                        @foreach($commonData->coffretsInformatiqueData as $task)
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
                    @if($commonData->coffretsInformatiqueData->isNotEmpty())

                        <p ><strong id="tst">Mesure de l'alimentation 220VAC: </strong> {{ $commonData->coffretsInformatiqueData->first()->input_220VAC }}</p>
                        <p><strong id="tst"> Mesure de l'alimentation 24VDC:  </strong> {{ $commonData->coffretsInformatiqueData->first()->input_24VDC }}</p>
                    @endif
                    </div>
                </div>
            </div>
        @endif
    </div>
{{--@endsection--}}
</x-app-layout>
