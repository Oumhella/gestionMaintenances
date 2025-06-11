<x-app-layout>
    <style>
        /* Base styling */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        /* Container styling */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        /* Header styling */
        h1, h2, h3 {
            color: #444;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Form styling */
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
            padding: 20px;
        }

        label {
            font-weight: bold;
            color: #555;
        }

        input[type="text"], input[type="date"], input[type="file"], select, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #f0f0f0;
            color: #333;
            box-sizing: border-box;
        }

        input[type="text"]:focus, input[type="date"]:focus, input[type="file"]:focus, select:focus, textarea:focus {
            border-color: #007bff;
            background-color: #fff;
            outline: none;
        }

        /* Button styling */
        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* Table styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fdfdfd;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: mediumslateblue;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        /* Footer styling */
        footer {
            margin-top: 20px;
            text-align: center;
            color: #888;
        }
    </style>
    <form action="{{ route('comptage_electrique.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="due_date">Date:</label>
            <input type="date" name="due_date" value="{{ session('due_date') }}" readonly>
        </div>

        <div>
            <label for="V1">Tensions simples (V) V1:</label>
            <input type="text" name="V1" value="{{ old('V1') }}">
        </div>
        <div>
            <label for="V2">Tensions simples (V) V2:</label>
            <input type="text" name="V2" value="{{ old('V2') }}">
        </div>
        <div>
            <label for="V3">Tensions simples (V) V3:</label>
            <input type="text" name="V3" value="{{ old('V3') }}">
        </div>
        <div>
            <label for="U12">Tensions composées (V) U12:</label>
            <input type="text" name="U12" value="{{ old('U12') }}">
        </div>
        <div>
            <label for="U23">Tensions composées (V) U23:</label>
            <input type="text" name="U23" value="{{ old('U23') }}">
        </div>
        <div>
            <label for="U31">Tensions composées (V) U31:</label>
            <input type="text" name="U31" value="{{ old('U31') }}">
        </div>
        <div>
            <label for="I1">Courants (A) I1:</label>
            <input type="text" name="I1" value="{{ old('I1') }}">
        </div>

        <div>
            <label for="I2">Courants (A) I2:</label>
            <input type="text" name="I2" value="{{ old('I2') }}">
        </div>
        <div>
            <label for="I3">Courants (A) I3:</label>
            <input type="text" name="I3" value="{{ old('I3') }}">
        </div>
        <div>
            <label for="Puissance_active_Total">Puissance active Total (kW):</label>
            <input type="text" name="Puissance_active_Total" value="{{ old('Puissance_active_Total') }}">
        </div>
        <div>
            <label for="Puissance_reactive_Total">Puissance réactive Total (kVAR):</label>
            <input type="text" name="Puissance_réactive_Total" value="{{ old('Puissance_reactive_Total') }}">
        </div>
        <div>
            <label for="Puissance_apparente_Total">Puissance apparente Total (kVA):</label>
            <input type="text" name="Puissance_apparente_Total" value="{{ old('Puissance_apparente_Total') }}">
        </div>
        <div>
            <label for="Energie_Active">Energie Active (kWh):</label>
            <input type="text" name="Energie_Active" value="{{ old('Energie_Active') }}">
        </div>



        <table>
            <tr>
                <th>Task</th>
                <th>Status</th>
                <th>Description</th>
                <th>Image</th>
            </tr>
            @foreach ($electriquetasks as $task)
                <tr>
                    <td>{{ $task->name }}
                        <input type="hidden" name="task_id[]" value="{{ $task->id }}">
                    </td>

                    <td>
                        <select name="task_status[{{ $task->id }}]">
                            @if ($task->checkbox_options === 'default')
                                <option value="bien">Bien</option>
                                <option value="moyen">Moyen</option>
                                <option value="panne">Panne</option>
                            @elseif ($task->checkbox_options === 'custom')
                                <option value="fait">Fait</option>
                                <option value="pas fait">Pas fait</option>
                            @endif
                        </select>
                    </td>

                    <td>
                        <input type="text" name="description[{{ $task->id }}]" placeholder="Task description for {{ $task->name }}">
                    </td>

                    <td>
                        <input type="file" name="images[{{ $task->id }}]">
                    </td>
                </tr>
            @endforeach
        </table>

        <button type="submit">Submit</button>
    </form>

</x-app-layout>
