<?php

namespace App\Http\Controllers;

use App\Models\CommonFormData;
use App\Models\Eau;
use App\Models\EauTask;
use App\Models\CoffretsInformatique; // Update your model name if needed
use App\Models\Electrique;
use App\Models\ElectriqueTask;
use App\Models\GE;
use App\Models\GETask;
use App\Models\GTC;
use App\Models\GtcTask;
use App\Models\Image;
use App\Models\PCS;
use App\Models\PcsTask;
use App\Models\CoffretsInformatiqueTask;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;

class TaskController extends Controller
{
    // Display the Coffrets Informatique form
    public function showCoffretsInformatique()
    {
        $tasks = CoffretsInformatiqueTask::all();
        return view('tasks.Coffrets_informatique', compact('tasks'));
    }
    public function coffretstore(Request $request)
    {
        // Validate form inputs, including images
        $request->validate([
            'due_date' => 'required|date',
            'input_220VAC' => 'nullable|string',
            'input_24VDC' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image uploads first and store paths by task ID
        $imagePaths = [];
        foreach ($request->file('images', []) as $taskId => $image) {
            $path = $image->storeAs('images', $image->getClientOriginalName(), 'public');
            $imagePaths[$taskId] = $path;
        }

        // Retrieve common_data_id from session
        $commonDataId = session('common_data_id');

        // Iterate over tasks and store them
        foreach ($request->input('task_id', []) as $index => $taskId) {
            $taskStatus = $request->input("task_status.$taskId");
            $description = $request->input("description.$taskId");

            CoffretsInformatique::create([
                'user_id' => Auth::id(),
                'due_date' => $request->due_date,
                'input_220VAC' => $request->input_220VAC,
                'input_24VDC' => $request->input_24VDC,
                'description' => $description,
                'task_id' => $taskId,
                'task_status' => $taskStatus,
                'form_type' => 'coffrets_informatique',
                'image' => $imagePaths[$taskId] ?? null,
                'common_data_id' => $commonDataId, // Associate with common data
            ]);
        }

        return redirect()->route('filterInterventions');
    }
    public function showgtc(): View
    {
        $gtctasks = GtcTask::all();
        return view('tasks.GTC', compact('gtctasks'));
    }

    // Store Coffrets Informatique form data
    public function gtcstore(Request $request): \Illuminate\Http\RedirectResponse
    {
        // Adjust validation rules if 'fonction' and 'name' aren't required for this form
        $request->validate([
            'due_date' => 'required|date',
            'input_220VAC' => 'nullable|string',
            'input_24VDC' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image uploads
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $taskId => $image) {
                if ($image && $image->isValid()) {
                    $path = $image->store('images', 'public');
                    $imagePaths[$taskId] = $path;
                }
            }
        }

        // Retrieve common_data_id from session
        $commonDataId = session('common_data_id');

        // Iterate over tasks and store them
        foreach ($request->input('task_id', []) as $index => $taskId) {
            $taskStatus = $request->input("task_status.$taskId");
            $description = $request->input("description.$taskId");

            $gtc = new GTC([
                'user_id' => Auth::id(),
                'due_date' => $request->due_date,
                'input_220VAC' => $request->input_220VAC,
                'input_24VDC' => $request->input_24VDC,
                'description' => $description,
                'task_id' => $taskId,
                'task_status' => $taskStatus,
                'form_type' => 'gtc',
                'common_data_id' => $commonDataId,
            ]);
            $gtc->image = $imagePaths[$taskId] ?? null;
            $gtc->save();
        }

        return redirect()->route('filterInterventions');
    }
    public function showge(): View
    {
        $getasks = GETask::all();
        return view('tasks.GE', compact('getasks'));
    }

    // Store GE form data
    public function gestore(Request $request)
    {
        // Validate form inputs
        $request->validate([
            'due_date' => 'required|date',
            'input_220VAC' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image uploads
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $taskId => $image) {
                if ($image && $image->isValid()) {
                    $path = $image->store('images', 'public');
                    $imagePaths[$taskId] = $path;
                }
            }
        }

        // Retrieve common_data_id from session
        $commonDataId = session('common_data_id');

        // Iterate over tasks and store them
        foreach ($request->input('task_id', []) as $index => $taskId) {
            $taskStatus = $request->input("task_status.$taskId");
            $description = $request->input("description.$taskId");

            $ge = new GE([
                'user_id' => Auth::id(),
                'due_date' => $request->due_date,
                'input_220VAC' => $request->input_220VAC,
                'description' => $description,
                'task_id' => $taskId,
                'task_status' => $taskStatus,
                'form_type' => 'ge',
                'common_data_id' => $commonDataId,
            ]);
            $ge->image = $imagePaths[$taskId] ?? null;
            $ge->save();
        }

        return redirect()->route('filterInterventions');
    }
    public function showpcs(): View
    {
        $pcstasks = PcsTask::all();
        return view('tasks.PCS', compact('pcstasks'));
    }

    // Store GE form data
    public function pcsstore(Request $request)
    {
        // Validate form inputs
        $request->validate([
            'due_date' => 'required|date',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image uploads
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $taskId => $image) {
                if ($image && $image->isValid()) {
                    $path = $image->store('images', 'public');
                    $imagePaths[$taskId] = $path;
                }
            }
        }

        // Retrieve common_data_id from session
        $commonDataId = session('common_data_id');

        // Iterate over tasks and store them
        foreach ($request->input('task_id', []) as $index => $taskId) {
            $taskStatus = $request->input("task_status.$taskId");
            $description = $request->input("description.$taskId");

            PCS::create([
                'user_id' => Auth::id(),
                'due_date' => $request->due_date,
                'description' => $description,
                'task_id' => $taskId,
                'task_status' => $taskStatus,
                'form_type' => 'pcs',
                'image' => $imagePaths[$taskId] ?? null,
                'common_data_id' => $commonDataId, // Associate with common data
            ]);
        }

        return redirect()->route('filterInterventions');
    }
    public function showeaucomptage(): View
    {
        $eautasks = EauTask::all();
        return view('tasks.comptage_eau', compact('eautasks'));
    }

    // Store Comptage d'eau form data
    public function eaustore(Request $request): \Illuminate\Http\RedirectResponse
    {
        // Validate form inputs
        $request->validate([
            'due_date' => 'required|date',
            'volume' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image uploads
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $taskId => $image) {
                if ($image && $image->isValid()) {
                    $path = $image->store('images', 'public');
                    $imagePaths[$taskId] = $path;
                }
            }
        }

        // Retrieve common_data_id from session
        $commonDataId = session('common_data_id');

        // Iterate over tasks and store them
        foreach ($request->input('task_id', []) as $index => $taskId) {
            $taskStatus = $request->input("task_status.$taskId");
            $description = $request->input("description.$taskId");

            $eau = new Eau([
                'user_id' => Auth::id(),
                'due_date' => $request->due_date,
                'volume' => $request->volume,
                'description' => $description,
                'task_id' => $taskId,
                'task_status' => $taskStatus,
                'form_type' => 'comptage_eau',
                'common_data_id' => $commonDataId,
            ]);
            $eau->image = $imagePaths[$taskId] ?? null;
            $eau->save();
        }

        return redirect()->route('filterInterventions');
    }
    public function showelectriquecomptage(): View
    {
        $electriquetasks = ElectriqueTask::all();
        return view('tasks.comptage_electrique', compact('electriquetasks'));
    }

    // Store Comptage d'eau form data
    public function electriquestore(Request $request): \Illuminate\Http\RedirectResponse
    {
        // Validate form inputs
        $request->validate([
            'due_date' => 'required|date',
            'V1' => 'nullable|string',
            'V2' => 'nullable|string',
            'V3' => 'nullable|string',
            'U12' => 'nullable|string',
            'U23' => 'nullable|string',
            'U31' => 'nullable|string',
            'I1' => 'nullable|string',
            'I2' => 'nullable|string',
            'I3' => 'nullable|string',
            'Puissance_active_Total' => 'nullable|string',
            'Puissance_reactive_Total' => 'nullable|string',
            'Puissance_apparente_Total' => 'nullable|string',
            'Energie_Active' => 'nullable|string',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle image uploads
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $taskId => $image) {
                if ($image && $image->isValid()) {
                    $path = $image->store('images', 'public');
                    $imagePaths[$taskId] = $path;
                }
            }
        }

        // Retrieve common_data_id from session
        $commonDataId = session('common_data_id');

        // Iterate over tasks and store them
        foreach ($request->input('task_id', []) as $index => $taskId) {
            $taskStatus = $request->input("task_status.$taskId");
            $description = $request->input("description.$taskId");

            $electrique = new Electrique([
                'user_id' => Auth::id(),
                'due_date' => $request->due_date,
                'V1' => $request->V1,
                'V2' => $request->V2,
                'V' => $request->V3,
                'U12' => $request->U12,
                'U23' => $request->U23,
                'U31' => $request->U31,
                'I1' => $request->I1,
                'I2' => $request->I2,
                'I3' => $request->I3,
                'Puissance_active_Total' => $request->Puissance_active_Total,
                'Puissance_reactive_Total' => $request->Puissance_reactive_Total,
                'Puissance_apparente_Total' => $request->Puissance_apparente_Total,
                'Energie_Active' => $request->Energie_Active,
                'description' => $description,
                'task_id' => $taskId,
                'task_status' => $taskStatus,
                'form_type' => 'comptage_electrique',
                'common_data_id' => $commonDataId,
            ]);
            $electrique->image = $imagePaths[$taskId] ?? null;
            $electrique->save();
        }

        return redirect()->route('filterInterventions');
    }
    // Store Coffrets Informatique form data
//    public function coffretstore(Request $request): \Illuminate\Http\RedirectResponse
//    {
//        // Validate form inputs
//        $request->validate([
//            'input_220VAC' => 'nullable|string',
//            'input_24VDC' => 'nullable|string',
//            'description' => 'nullable|string',
//            'task_id' => 'required|exists:coffrets_informatique_tasks,id', // Ensure it references a valid task
//            'task_status' => 'nullable|in:bien,moyen,panne,fait,pas fait',
//            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
//        ]);
//        // Handle image uploads
//        $imagePaths = $this->handleImageUploads($request, 'coffrets_informatique');
//        // Store form-specific data (tasks, images)
//        $this->storeFormData($request, $imagePaths, 'coffrets_informatique','task_');
//
//        return redirect()->route('coffrets_informatique')->with('success', 'Form submitted successfully!');
//    }

//    public function coffretstore(Request $request): \Illuminate\Http\RedirectResponse
//    {
//        // Validate form inputs
//        $request->validate([
//            'fonction' => 'required|string|max:255',
//            'name' => 'required|string|max:255',
//            'due_date' => 'required|date',
//            'input_220VAC' => 'nullable|string',
//            'input_24VDC' => 'nullable|string',
//            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
//        ]);
//
//        // Handle image uploads
//        $imagePaths = $this->handleImageUploads($request, 'coffrets_informatique');
//
//        // Store task-related data
//        $this->storeFormData($request, $imagePaths, 'coffrets_informatique','task_');
//
//        return redirect()->route('coffrets_informatique')->with('success', 'Form submitted successfully!');
//    }

    // Selection page for interventions
    public function selection()
    {
        return view('intervention_selection');
    }

    // Overview of interventions
//    public function overview(): View
//    {
//        $interventions = CoffretsInformatique::all(); // Updated reference
//        return view('intervention_overview', compact('interventions'));
//    }

    // Show form data and images for Coffrets Informatique
//    public function show()
//    {
//        $formData = DB::table('coffrets_informatique')
//            ->leftJoin('coffrets_informatique_tasks', 'coffrets_informatique.task_id', '=', 'coffrets_informatique_tasks.id')
//            ->leftJoin('images', function($join) {
//                $join->on('coffrets_informatique.task_id', '=', 'images.task_id')
//                    ->where('images.form_type', 'coffrets_informatique');
//            })
//            ->select('coffrets_informatique.*', 'coffrets_informatique_tasks.name as task_name', 'images.image')
//            ->where('coffrets_informatique.form_type', 'coffrets_informatique')
//            ->get();
//
//        return view('show', compact('formData'));
//    }

    // Show all images
//    public function showImages()
//    {
//        $images = Image::all();
//        return view('show_images', compact('images'));
//    }

    // Export data as PDF
    public function exportPdf()
    {
        $formData = DB::table('coffrets_informatique')
            ->join('tasks', 'coffrets_informatique.task_id', '=', 'tasks.id')
            ->select('coffrets_informatique.*', 'tasks.name as task_name')
            ->get();

        $pdf = Pdf::loadView('show', compact('formData'));
        return $pdf->download('coffrets_informatique_report.pdf');
    }

    // Store common data from the form and redirect
    public function storeCommonData(Request $request)
    {
        // Validate common fields
        $data = $request->validate([
            'name' => 'required|string',
            'fonction' => 'required|string',
            'due_date' => 'required|date',
            'equipement' => 'required|string',
            'form_type' => 'required|string',
        ]);

        // Add authenticated user's ID
        $data['user_id'] = Auth::id();
        session(['due_date' => $data['due_date']]);

        // Store common data in the FormData table
        $commonData = CommonFormData::create($data);

        // Store the common data ID in the session for later use
        session(['common_data_id' => $commonData->id]);

        // Redirect to the specific form's store method based on form_type
        return redirect()->route($data['form_type'] . '.store');
    }


    // Filter interventions by date
    public function filterInterventions(Request $request)
    {
        $filter_date = $request->input('filter_date');
        $interventions = CommonFormData::where('due_date', $filter_date)->get(); // Updated reference
        return view('intervention_filter', compact('interventions'));
    }

    // Show a specific intervention based on ID and form type
    public function showIntervention($id)
    {
        // Retrieve the common data with basic relationships
        $commonData = CommonFormData::findOrFail($id);

        // Load specific relationships and determine view based on form type
        switch ($commonData->form_type) {
            case 'coffrets_informatique':
                $commonData->load(['coffretsInformatiqueData', 'coffretsInformatiqueData.task', 'coffretsInformatiqueData.images']);
                $view = 'Show'; // Coffrets Informatique view
                break;

            case 'gtc':
                $commonData->load(['gtcData', 'gtcData.task', 'gtcData.images']);
                $view = 'show_gtc'; // GTC form view
                break;

            case 'ge':
                $commonData->load(['geData', 'geData.task', 'geData.images']);
                $view = 'show_ge'; // GTC form view
                break;

            case 'pcs':
                $commonData->load(['pcsData', 'pcsData.task', 'pcsData.images']);
                $view = 'show_pcs'; // GTC form view
                break;

            case 'comptage_eau':
                $commonData->load(['eauData', 'eauData.task', 'eauData.images']);
                $view = 'show_eau'; // GTC form view
                break;
            case 'comptage_electrique':
                $commonData->load(['electriqueData', 'electriqueData.task', 'electriqueData.images']);
                $view = 'show_electrique'; // GTC form view
                break;


            // Add other form types here as needed
            // case 'other_form_type':
            //     $commonData->load(['otherData', 'otherData.task', 'otherData.images']);
            //     $view = 'show_other_form';
            //     break;

            default:
                abort(404, 'Form type not supported');
        }

        return view($view, compact('commonData'));
    }




    // Show the form data and images for various types
//    public function show_gtc()
//    {
//        return $this->showFormData('gtc', GtcTask::class, 'show_gtc');
//    }

//    public function show_eau()
//    {
//        return $this->showFormData('eau', EauTask::class, 'show_eau', 'comptage_eau');
//    }
//
//    public function show_ge()
//    {
//        return $this->showFormData('ge', GETask::class, 'show_ge');
//    }
//
//    public function show_pcs()
//    {
//        return $this->showFormData('pcs', PcsTask::class, 'show_pcs');
//    }

    // Show form data for a specific type
//    private function showFormData($formType, $taskModel, $viewName, $formCondition = null)
//    {
//        $data = DB::table($formType)
//            ->leftJoin("{$formType}_tasks", "{$formType}.task_id", '=', "{$formType}_tasks.id")
//            ->leftJoin('images', function($join) use ($formType) {
//                $join->on("{$formType}.task_id", '=', 'images.task_id')
//                    ->where('images.form_type', $formType);
//            })
//            ->select("{$formType}.*", "{$formType}_tasks.name as task_name", 'images.image')
//            ->where("{$formType}.form_type", $formCondition ?? $formType)
//            ->get();
//
//        $images = DB::table('images')
//            ->where('form_type', $formType)
//            ->get();
//
//        return view($viewName, compact('data', 'images'));
//    }

    // Display the Comptage d'eau form


    // Show GE form


    // Handle image uploads for the form
//    private function handleImageUploads(Request $request, string $formType): array
//    {
//        $imagePaths = [];
//        foreach ($request->allFiles() as $key => $file) {
//            if (str_contains($key, 'image_')) {
//                $taskId = str_replace('image_', '', $key);
//                $path = $file->store('images', 'public');
//                Image::create([
//                    'user_id' => Auth::id(),
//                    'task_id' => $taskId,
//                    'form_type' => $formType,
//                    'image' => $path,
//                ]);
//                $imagePaths[] = $path;
//            }
//        }
//        return $imagePaths;
//    }

    // Store form data in the respective tables
//    private function storeFormData(Request $request, array $imagePaths, string $formType, string $taskPrefix = 'task_', string $volumeField = null)
//    {
//        $data = [
//            'fonction' => $request->input('fonction'),
//            'name' => $request->input('name'),
//            'due_date' => $request->input('due_date'),
//            'form_type' => $formType,
//        ];
//
//        if ($volumeField) {
//            $data[$volumeField] = $request->input($volumeField);
//        }
//
//        $formData = CoffretsInformatique::create($data); // Update as needed
//
//        foreach ($imagePaths as $imagePath) {
//            Image::create([
//                'user_id' => Auth::id(),
//                'task_id' => $formData->id, // Associate with the new form data
//                'form_type' => $formType,
//                'image' => $imagePath,
//            ]);
//        }
//    }
//    private function storeFormData(Request $request, array $imagePaths, string $formType, string $taskPrefix = 'task_')
//    {
//        // Retrieve the intervention entry using the passed form ID
//        $interventionId = Auth::id(); // Use the authenticated user ID
//        $formData = CoffretsInformatique::where('user_id', $interventionId)->first();
//        // Ensure you pass this ID from the previous step
////        $formData = null;
//
//        // Determine which model to use based on the formType
//        switch ($formType) {
//            case 'coffrets_informatique':
//                $formData = CoffretsInformatique::find($interventionId);
//                break;
//            case 'another_form_type': // Replace with actual form type
//                // $formData = AnotherFormType::find($interventionId);
//                break;
//            // Add more cases for each form type
//            default:
//                abort(404, 'Form type not supported.');
//        }
//
//        if (!$formData) {
//            abort(404, 'Intervention not found.');
//        }
//
//        // Update task-specific details
////        $formData->update([
////            'input_220VAC' => $request->input('input_220VAC'),
////            'input_24VDC' => $request->input('input_24VDC'),
////            'description'=> $request->input('description'),
////            'task_id' => $request->input('task_id'),
////            'task_status' => $request->input('task_status'),
////
////            // Include other fields specific to the form type as needed
////        ]);
//        $updateData = [
//            'input_220VAC' => $request->input('input_220VAC'),
//            'input_24VDC' => $request->input('input_24VDC'),
//            'description' => $request->input('description'),
//        ];
//
//// This part is for updating the formData
//        $formData->update($updateData);
//
//// Ensure tasks and images are stored regardless of description or task fields
//        if ($request->has('task_id') || $request->has('task_status')) {
//            $taskId = $request->input('task_id') ?? null;
//            $taskStatus = $request->input('task_status') ?? null;
//
//            if ($taskId || $taskStatus) {
//                $formData->update([
//                    'task_id' => $taskId,
//                    'task_status' => $taskStatus,
//                ]);
//            }
//        }
//
//// Ensure images are stored regardless of description or task fields
//        if (!empty($imagePaths)) {
//            foreach ($imagePaths as $imagePath) {
//                Image::create([
//                    'user_id' => Auth::id(),
//                    'task_id' => $formData->id, // Ensure you're associating the image with the right task/form
//                    'form_type' => $formType,
//                    'image' => $imagePath,
//                ]);
//            }
//        }
//    }
    }
///////////////////////////////////////////////////////////////////////////////////////////////
//
//namespace App\Http\Controllers;
//
//use App\Models\Eau;
//use App\Models\EauTask;
//use App\Models\CoffretsInformatique;
//use App\Models\GE;
//use App\Models\GETask;
//use App\Models\GTC;
//use App\Models\GtcTask;
//use App\Models\Image;
//use App\Models\PCS;
//use App\Models\PcsTask;
//use App\Models\CoffretsInformatiqueTask;
//use App\Models\User;
//use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Auth;
//use Illuminate\Support\Facades\DB;
//use Illuminate\View\View;
//use Barryvdh\DomPDF\Facade\Pdf;
//
//class TaskController extends Controller
//{
//    // Display Coffrets Informatique form
//    public function showCoffretsInformatique(): View
//    {
//        $tasks = CoffretsInformatiqueTask::all();
//        return view('tasks.Coffrets_informatique', compact('tasks'));
//    }
//
//    // Store Coffrets Informatique form data
//    public function coffretstore(Request $request): \Illuminate\Http\RedirectResponse
//    {
//        // Validate form inputs, including images
//        $request->validate([
//            'fonction' => 'required|string|max:255',
//            'name' => 'required|string|max:255',
//            'due_date' => 'required|date',
//            'input_220VAC' => 'nullable|string',
//            'input_24VDC' => 'nullable|string',
//            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
//        ]);
//
//        // Handle image uploads first
//        $imagePaths = [];
//        foreach ($request->allFiles() as $key => $file) {
//            if (str_contains($key, 'image_')) {
//                $taskId = str_replace('image_', '', $key);
//                $imagePath = $file->store('images', 'public');
//                $imagePaths[$taskId] = basename($imagePath);
//
//                // Save image path in the `images` table
//                Image::create([
//                    'user_id' => Auth::id(),
//                    'task_id' => $taskId,
//                    'form_type' => 'coffrets_informatique',
//                    'image' => basename($imagePath),
//                ]);
//            }
//        }
//
//        // Store task-related data
//        foreach ($request->except('_token', 'fonction', 'name', 'due_date', 'input_220VAC', 'input_24VDC', 'images') as $key => $value) {
//            if (str_contains($key, 'task_')) {
//                $taskId = str_replace('task_', '', $key);
//
//                CoffretsInformatique::create([
//                    'user_id' => Auth::id(),
//                    'fonction' => $request->fonction,
//                    'name' => $request->name,
//                    'due_date' => $request->due_date,
//                    'input_220VAC' => $request->input_220VAC,
//                    'input_24VDC' => $request->input_24VDC,
//                    'description' => $request->input('description_' . $taskId),
//                    'task_id' => $taskId,
//                    'task_status' => $value,
//                    'form_type' => 'coffrets_informatique',
//                    'image' => $imagePaths[$taskId] ?? null,
//                ]);
//            }
//        }
//
//        return redirect()->route('coffrets_informatique')->with('success', 'Form submitted successfully!');
//    }
//    public function selection(): View
//    {
//        // Logic to fetch data needed for selection page (e.g., tasks, interventions)
//        $interventions = CoffretsInformatique::all(); // Assuming you are fetching all interventions
//        return view('intervention_selection', compact('interventions'));
//    }
//    public function overview(): View
//    {
//        $interventions = CoffretsInformatique::all(); // Fetch all interventions for overview
//        return view('intervention_overview', compact('interventions'));
//    }
//
//
//    // Show form data and images for Coffrets Informatique
//    public function show()
//    {
//        $formData = DB::table('form_data')
//            ->leftJoin('tasks', 'form_data.task_id', '=', 'tasks.id')
//            ->leftJoin('images', function($join) {
//                $join->on('form_data.task_id', '=', 'images.task_id')
//                    ->where('images.form_type', 'coffrets_informatique');
//            })
//            ->select('form_data.*', 'tasks.name as task_name', 'images.image')
//            ->where('form_data.form_type', 'coffrets_informatique')
//            ->get();
//
//        return view('show', compact('formData'));
//    }
//
//    // Show all images
//    public function showImages()
//    {
//        $images = Image::all();
//        return view('show_images', compact('images'));
//    }
//
//    // Export PDF
//    public function exportPdf()
//    {
//        $formData = DB::table('form_data')
//            ->join('tasks', 'form_data.task_id', '=', 'tasks.id')
//            ->select('form_data.*', 'tasks.name as task_name')
//            ->get();
//
//        $pdf = Pdf::loadView('show', compact('formData'));
//        return $pdf->download('coffrets_informatique_report.pdf');
//    }
//
//    // Store common data from the form and redirect to the selected form
//    public function storeCommonData(Request $request)
//    {
//        $data = $request->validate([
//            'name' => 'required|string',
//            'fonction' => 'required|string',
//            'due_date' => 'required|date',
//            'form_type' => 'required|string',
//        ]);
//
//        // Add the authenticated user's ID
//        $data['user_id'] = Auth::id();
//
//        $intervention = CoffretsInformatique::create($data);
//
//        return redirect()->route('showIntervention', ['id' => $intervention->id, 'form_type' => $data['form_type']]);
//    }
//
//
//    // Filter interventions by date
//    public function filterInterventions(Request $request)
//    {
//        $filter_date = $request->input('filter_date');
//        $interventions = CoffretsInformatique::where('due_date', $filter_date)->get();
//        return view('intervention_sur_site', compact('interventions'));
//    }
//
//    // Show a specific intervention based on ID and form type
//    public function showIntervention($id, $form_type)
//    {
//        $formData = CoffretsInformatique::where('id', $id)->where('form_type', $form_type)->firstOrFail();
//        return view('Show', compact('formData'));
//    }
//
//    // Show form data and images for Coffrets Informatique
//
//    public function show_gtc()
//    {
//        $gtc = DB::table('gtc')
//            ->leftJoin('gtc_tasks', 'gtc.task_id', '=', 'gtc_tasks.id')
//            ->leftJoin('images', function($join) {
//                $join->on('gtc.task_id', '=', 'images.task_id') // Corrected this line
//                ->where('images.form_type', 'gtc');
//            })
//            ->select('gtc.*', 'gtc_tasks.name as task_name', 'images.image')
//            ->where('gtc.form_type', 'gtc')
//            ->get();
//
//
//
//        $images = DB::table('images')
//            ->where('form_type', 'gtc')
//            ->get();
//
//        return view('show_gtc', compact('gtc', 'images'));
//    }
//    public function show_eau()
//    {
//        $eau = DB::table('eau')
//            ->leftJoin('eau_tasks', 'eau.task_id', '=', 'eau_tasks.id')
//            ->leftJoin('images', function($join) {
//                $join->on('eau.task_id', '=', 'images.task_id') // Corrected this line
//                ->where('images.form_type', 'eau');
//            })
//            ->select('eau.*', 'eau_tasks.name as task_name', 'images.image')
//            ->where('eau.form_type', 'comptage_eau')
//            ->get();
//
//
//
//        $images = DB::table('images')
//            ->where('form_type', 'comptage_eau')
//            ->get();
//
//        return view('show_eau', compact('eau', 'images'));
//    }
//    public function show_ge()
//    {
//        $ge = DB::table('ge')
//            ->leftJoin('ge_tasks', 'ge.task_id', '=', 'ge_tasks.id')
//            ->leftJoin('images', function($join) {
//                $join->on('ge.task_id', '=', 'images.task_id') // Corrected this line
//                ->where('images.form_type', 'ge');
//            })
//            ->select('ge.*', 'ge_tasks.name as task_name', 'images.image')
//            ->where('ge.form_type', 'ge')
//            ->get();
//
//
//
//        $images = DB::table('images')
//            ->where('form_type', 'ge')
//            ->get();
//
//        return view('show_ge', compact('ge', 'images'));
//    }
//    public function show_pcs()
//    {
//        $pcs = DB::table('pcs')
//            ->leftJoin('pcs_tasks', 'pcs.task_id', '=', 'pcs_tasks.id')
//            ->leftJoin('images', function($join) {
//                $join->on('pcs.task_id', '=', 'images.task_id') // Corrected this line
//                ->where('images.form_type', 'pcs');
//            })
//            ->select('pcs.*', 'pcs_tasks.name as task_name', 'images.image')
//            ->where('pcs.form_type', 'pcs')
//            ->get();
//
//
//
//        $images = DB::table('images')
//            ->where('form_type', 'pcs')
//            ->get();
//
//        return view('show_pcs', compact('pcs', 'images'));
//    }
//
//
//
//    // Display a specific form data entry
////    public function show($id): View
////    {
////        $formData = CoffretsInformatique::findOrFail($id);
////        $tasks = CoffretsInformatiqueTask::whereIn('id', [$formData->task_id])->get();
////        return view('tasks.show', compact('formData', 'tasks'));
////    }
//
//    // Display Comptage d'eau form
//    public function showeaucomptage(): View
//    {
//        $eautasks = EauTask::all();
//        return view('tasks.comptage_eau', compact('eautasks'));
//    }
//
//    // Store Comptage d'eau form data
//    public function eaustore(Request $request): \Illuminate\Http\RedirectResponse
//    {
//        $request->validate([
//            'fonction' => 'required|string|max:255',
//            'name' => 'required|string|max:255',
//            'due_date' => 'required|date',
//            'volume' => 'required|numeric',
//            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
//
//        ]);
//        foreach ($request->except('_token', 'fonction', 'name', 'due_date', 'volume') as $key => $value) {
//            if (str_contains($key, 'task_')) {
//                $taskeauId = str_replace('task_', '', $key);
//
//                Eau::create([
//                    'user_id' => Auth::id(),
//                    'fonction' => $request->input('fonction'),
//                    'name' => $request->input('name'),
//                    'due_date' => $request->input('due_date'),
//                    'volume' => $request->input('volume'),
//                    'description' => $request->input('description_' . $taskeauId),
//                    'task_id' => $taskeauId,
//                    'task_status' => $value,
//                    'form_type' => 'comptage_eau',
//                    'image' => $imagePaths[$taskeauId] ?? null,
//                ]);
//            }
//        }
//                $imagePaths = [];
//                foreach ($request->all() as $key => $value) {
//                    if (str_contains($key, 'image_')) {
//                        $taskeauId = str_replace('image_', '', $key); // Extract task ID
//                        if ($request->hasFile($key)) {
//                            $imageFile = $request->file($key);
//                            $imagePath = $imageFile->store('images', 'public');
////                    $imagePath = $request->file('image')->store('images', 'public');
//
//
//                            // Save image path to array
//                            $imagePaths[$taskeauId] = basename($imagePath);
//
//                            // Also save to `images` table
//                            Image::create([
//                                'user_id' => Auth::id(),
//                                'task_id' => $taskeauId,
//                                'form_type' => 'comptage_eau',
//                                'image' => basename($imagePath),
//                            ]);
//
//
//                }
//            }
//                        }
//                        return redirect()->route('comptage_eau')->with('success', 'Data stored successfully!');
//                    }
//    public function showge(): View
//    {
//        $getasks = GETask::all(); // Retrieves all tasks from 'ge_tasks' table
//        return view('tasks.GE', compact('getasks'));
//    }
//
//
//    public function gestore(Request $request)
//    {
//        // Validate form inputs
//        $request->validate([
//            'fonction' => 'required|string|max:255',
//            'name' => 'required|string|max:255',
//            'due_date' => 'required|date',
//            'input_220VAC' => 'nullable|string',
//            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
//            // Add validation rules for other fields as needed
//        ]);
//
//        foreach ($request->except('_token', 'fonction', 'name', 'due_date', 'input_220VAC') as $key => $value) {
//            if (str_contains($key, 'task_')) {
//                $taskgeId = str_replace('task_', '', $key);
//                GE::create([
//                    'user_id' => Auth::id(),
//                    'fonction' => $request->fonction,
//                    'name' => $request->name,
//                    'due_date' => $request->due_date,
//                    'input_220VAC' => $request->input_220VAC,
//                    'description' => $request->input('description_' . $taskgeId),
//                    'task_id' => $taskgeId,
//                    'task_status' => $value,
//                    'form_type' => 'ge',
//                    'image' => $imagePaths[$taskgeId] ?? null,
//                ]);
//            }}
//        $imagePaths = [];
//        foreach ($request->all() as $key => $value) {
//            if (str_contains($key, 'image_')) {
//                $taskgeId = str_replace('image_', '', $key); // Extract task ID
//                if ($request->hasFile($key)) {
//                    $imageFile = $request->file($key);
//                    $imagePath = $imageFile->store('images', 'public');
////                    $imagePath = $request->file('image')->store('images', 'public');
//
//
//                    // Save image path to array
//                    $imagePaths[$taskgeId] = basename($imagePath);
//
//                    // Also save to `images` table
//                    Image::create([
//                        'user_id' => Auth::id(),
//                        'task_id' => $taskgeId,
//                        'form_type' => 'ge',
//                        'image' => basename($imagePath),
//                    ]);
//                }
//            }
//        }
//
//
//
//        return redirect()->route('ge')->with('success', 'Form submitted successfully!');
//    }
//
//
//    public function showgtc(): View
//    {
//        $gtctasks = GtcTask::all();
//        return view('tasks.GTC', compact('gtctasks'));
//    }
//
//    // Store Coffrets Informatique form data
//    public function gtcstore(Request $request): \Illuminate\Http\RedirectResponse
//    {
//        // Validate the form inputs
//        $request->validate([
//            'fonction' => 'required|string|max:255',
//            'name' => 'required|string|max:255',
//            'due_date' => 'required|date',
//            'input_220VAC' => 'nullable|string',
//            'input_24VDC' => 'nullable|string',
//            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
//        ]);
//
//        // Loop through the request data and store each task-related data
//        foreach ($request->except('_token', 'fonction', 'name', 'due_date', 'input_220VAC', 'input_24VDC') as $key => $value) {
//            if (str_contains($key, 'task_')) {
//                $taskgtcId = str_replace('task_', '', $key);
//
//                // Save form data to the `form_data` table
//                GTC::create([
//                    'user_id' => Auth::id(),
//                    'fonction' => $request->fonction,
//                    'name' => $request->name,
//                    'due_date' => $request->due_date,
//                    'input_220VAC' => $request->input_220VAC,
//                    'input_24VDC' => $request->input_24VDC,
//                    'description' => $request->input('description_' . $taskgtcId),
//                    'task_id' => $taskgtcId,
//                    'task_status' => $value,
//                    'form_type' => 'gtc',
//                    'image' => $imagePaths[$taskgtcId] ?? null,
//                ]);
//            }
//        }
//
//        // Handle image uploads
//        // Handle image uploads
//        $imagePaths = [];
//        foreach ($request->all() as $key => $value) {
//            if (str_contains($key, 'image_')) {
//                $taskgtcId = str_replace('image_', '', $key); // Extract task ID
//                if ($request->hasFile($key)) {
//                    $imageFile = $request->file($key);
//                    $imagePath = $imageFile->store('images', 'public');
////                    $imagePath = $request->file('image')->store('images', 'public');
//
//
//                    // Save image path to array
//                    $imagePaths[$taskgtcId] = basename($imagePath);
//
//                    // Also save to `images` table
//                    Image::create([
//                        'user_id' => Auth::id(),
//                        'task_id' => $taskgtcId,
//                        'form_type' => 'gtc',
//                        'image' => basename($imagePath),
//                    ]);
//                }
//            }
//        }
//
//
//        // Redirect back with a success message
//        return redirect()->route('gtc')->with('success', 'Form submitted successfully!');
//    }
//
//
//
//    public function showpcs(): View
//    {
//        $pcstasks = PcsTask::all();
//        return view('tasks.PCS', compact('pcstasks'));
//    }
//
//// Store GTC form data
//    public function pcsstore(Request $request): \Illuminate\Http\RedirectResponse
//    {
//        $request->validate([
//            'fonction' => 'required|string|max:255',
//            'name' => 'required|string|max:255',
//            'due_date' => 'required|date',
//            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
//
//        ]);
//        foreach ($request->except('_token', 'fonction', 'name', 'due_date') as $key => $value) {
//            if (str_contains($key, 'task_')) {
//                $taskpcsId = str_replace('task_', '', $key);
//                PCS::create([
//                    'user_id' => Auth::id(),
//                    'fonction' => $request->fonction,
//                    'name' => $request->name,
//                    'due_date' => $request->due_date,
//                    'description' => $request->input('description_' . $taskpcsId),
//                    'task_id' => $taskpcsId,
//                    'task_status' => $value,
//                    'form_type' => 'pcs',
//                    'image' => $imagePaths[$taskpcsId] ?? null,
//
//
//                ]);
//            }}
//                $imagePaths = [];
//                foreach ($request->all() as $key => $value) {
//                    if (str_contains($key, 'image_')) {
//                        $taskpcsId = str_replace('image_', '', $key); // Extract task ID
//                        if ($request->hasFile($key)) {
//                            $imageFile = $request->file($key);
//                            $imagePath = $imageFile->store('images', 'public');
//
//                            // Save image path to array
//                            $imagePaths[$taskpcsId] = basename($imagePath);
//
//                            // Also save to `images` table
//                            Image::create([
//                                'user_id' => Auth::id(),
//                                'task_id' => $taskpcsId,
//                                'form_type' => 'pcs',
//                                'image' => basename($imagePath),
//                            ]);
//                        }
//                    }
//
//                }
//
//            return redirect()->route('pcs')->with('success', 'Form submitted successfully!');
//
//
//    }
//
//}

