
<style>
x-app-layout {
display: block;
padding: 20px;
background-color: #f4f4f9;
font-family: Arial, sans-serif;
}

/* Header style */
h1 {
font-size: 24px;
color: #333;
text-align: center;
margin-bottom: 30px;
}

/* Form styling */
form {
background-color: white;
padding: 30px;
border-radius: 8px;
box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
max-width: 500px;
margin: 0 auto;
}

/* Label styling */
label {
font-size: 14px;
color: #555;
font-weight: bold;
margin-bottom: 8px;
display: block;
}

/* Input styling */
input[type="text"],
input[type="date"],
select {
width: 100%;
padding: 12px;
border: 1px solid #ccc;
border-radius: 4px;
margin-bottom: 20px;
font-size: 14px;
background-color: #fafafa;
}

/* Dropdown styling */
.dropdown {
margin-bottom: 20px;
}

.form-control {
border-radius: 4px;
font-size: 14px;
}

/* Button styling */
button[type="submit"] {
background-color: #007bff;
color: white;
padding: 12px 20px;
border: none;
border-radius: 4px;
font-size: 16px;
cursor: pointer;
display: block;
width: 100%;
transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
background-color: #0056b3;
}

/* Responsive adjustments */
@media screen and (max-width: 600px) {
form {
padding: 20px;
margin: 10px;
}

button[type="submit"] {
padding: 10px 15px;
}
}
</style>
<x-app-layout>
    <h1>Intervention Selection</h1>

    <form method="POST" action="{{ route('storeCommonData') }}">
        @csrf
        <div>
            <label for="name">Name:</label>
            <input type="text" name="name" value="{{ Auth::user()->name }}" readonly>
        </div>

        <div>
            <label for="fonction">Function:</label>
            <input type="text" name="fonction" value="{{ Auth::user()->fonction }}" readonly>
        </div>

        <div>
            <label for="due_date">Date:</label>
            <input type="date" name="due_date" required>
        </div>

        <div>
            <label for="equipement">Equipement:</label>
            <input type="text" name="equipement" required>
        </div>

        <div class="dropdown mt-4">
            <label for="form_type">Select Form:</label>
            <select name="form_type" class="form-control">
                <option value="coffrets_informatique">Coffrets Informatique</option>
                <option value="gtc">GTC Form</option>
                <option value="ge">GE Form</option>
                <option value="comptage_eau">Eau Form</option>
                <option value="pcs">Salles pcs Form</option>
                <option value="comptage_electrique">Comptage electrique Form</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Proceed to Selected Form</button>
    </form>
</x-app-layout>
