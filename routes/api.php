<?php

use App\Http\Controllers\WeeklyPlanningController;
use Illuminate\Support\Facades\Route;

Route::apiResource('weekly-plannings', WeeklyPlanningController::class);
