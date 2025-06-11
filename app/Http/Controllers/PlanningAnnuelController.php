<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class PlanningAnnuelController extends Controller
{
    public function index()
    {
        return view('planning_annuel');
    }

    public function fetch(Request $request)
    {
        $events = Event::whereBetween('start', [$request->start, $request->end])
            ->get(['id', 'title', 'start', 'end']); // Only return necessary fields

        return response()->json($events);
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'start' => 'required|date',
            'end'   => 'required|date|after_or_equal:start',
        ]);

        $event = $request->id
            ? Event::find($request->id)->update($validated)
            : Event::create($validated);

        return response()->json(['success' => true]);
    }

}
