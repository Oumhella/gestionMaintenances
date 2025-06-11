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
    <form action="{{ route('comptage_eau.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="due_date">Date:</label>
            <input type="date" name="due_date" value="{{ session('due_date') }}" readonly>
        </div>

        <div>
            <label for="volume">Volume en m3 :</label>
            <input type="text" name="volume" value="{{ old('volume') }}">
        </div>


        <table>
            <tr>
                <th>Task</th>
                <th>Status</th>
                <th>Description</th>
                <th>Image</th>
            </tr>
            @foreach ($eautasks as $task)
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
