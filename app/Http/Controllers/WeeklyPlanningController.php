<?php

namespace App\Http\Controllers;

use App\Models\WeeklyPlanning;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WeeklyPlanningController extends Controller
{
    public function index(): JsonResponse
    {
        $weeklyPlannings = WeeklyPlanning::query()
            ->orderByDesc('week_date')
            ->latest()
            ->get();

        return response()->json($weeklyPlannings);
    }

    public function store(Request $request): JsonResponse
    {
        $weeklyPlanning = WeeklyPlanning::create($request->validate($this->rules()));

        return response()->json($weeklyPlanning, 201);
    }

    public function show(WeeklyPlanning $weeklyPlanning): JsonResponse
    {
        return response()->json($weeklyPlanning);
    }

    public function update(Request $request, WeeklyPlanning $weeklyPlanning): JsonResponse
    {
        $weeklyPlanning->update($request->validate($this->rules()));

        return response()->json($weeklyPlanning->fresh());
    }

    public function destroy(WeeklyPlanning $weeklyPlanning): JsonResponse
    {
        $weeklyPlanning->delete();

        return response()->json(null, 204);
    }

    /**
     * @return array<string, string>
     */
    private function rules(): array
    {
        return [
            'school_name' => 'required|string|max:255',
            'teacher_name' => 'required|string|max:255',
            'segment' => 'required|string|max:255',
            'week_date' => 'required|date',
            'monday_reading' => 'nullable|string',
            'monday_learning_objectives' => 'nullable|string',
            'monday_pedagogical_proposal' => 'nullable|string',
            'monday_development' => 'nullable|string',
            'monday_specialists_schedule' => 'nullable|string',
            'tuesday_reading' => 'nullable|string',
            'tuesday_learning_objectives' => 'nullable|string',
            'tuesday_pedagogical_proposal' => 'nullable|string',
            'tuesday_development' => 'nullable|string',
            'tuesday_specialists_schedule' => 'nullable|string',
            'wednesday_reading' => 'nullable|string',
            'wednesday_learning_objectives' => 'nullable|string',
            'wednesday_pedagogical_proposal' => 'nullable|string',
            'wednesday_development' => 'nullable|string',
            'wednesday_specialists_schedule' => 'nullable|string',
            'thursday_reading' => 'nullable|string',
            'thursday_learning_objectives' => 'nullable|string',
            'thursday_pedagogical_proposal' => 'nullable|string',
            'thursday_development' => 'nullable|string',
            'thursday_specialists_schedule' => 'nullable|string',
            'friday_reading' => 'nullable|string',
            'friday_learning_objectives' => 'nullable|string',
            'friday_pedagogical_proposal' => 'nullable|string',
            'friday_development' => 'nullable|string',
            'friday_specialists_schedule' => 'nullable|string',
            'weekly_report' => 'nullable|string',
            'materials_request' => 'nullable|string',
            'coordinator_feedback' => 'nullable|string',
        ];
    }
}
