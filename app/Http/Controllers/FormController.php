<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function storeCommonData(Request $request)
    {
        // Validate the input
        $request->validate([
            'name' => 'required|string|max:255',
            'fonction' => 'required|string|max:255',
            'due_date' => 'required|date',
        ]);

        // Store common data in session or temporary storage
        session([
            'name' => $request->name,
            'fonction' => $request->fonction,
            'due_date' => $request->due_date,
        ]);

        // Redirect to the selected form
        $formType = $request->form_type;
        return redirect()->route($formType);
    }

}
