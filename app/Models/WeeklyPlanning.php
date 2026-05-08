<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WeeklyPlanning extends Model
{
    protected $fillable = [
        'school_name',
        'teacher_name',
        'segment',
        'week_date',
        'monday_reading',
        'monday_learning_objectives',
        'monday_pedagogical_proposal',
        'monday_development',
        'monday_specialists_schedule',
        'tuesday_reading',
        'tuesday_learning_objectives',
        'tuesday_pedagogical_proposal',
        'tuesday_development',
        'tuesday_specialists_schedule',
        'wednesday_reading',
        'wednesday_learning_objectives',
        'wednesday_pedagogical_proposal',
        'wednesday_development',
        'wednesday_specialists_schedule',
        'thursday_reading',
        'thursday_learning_objectives',
        'thursday_pedagogical_proposal',
        'thursday_development',
        'thursday_specialists_schedule',
        'friday_reading',
        'friday_learning_objectives',
        'friday_pedagogical_proposal',
        'friday_development',
        'friday_specialists_schedule',
        'weekly_report',
        'materials_request',
        'coordinator_feedback',
    ];

    protected function casts(): array
    {
        return [
            'week_date' => 'date',
        ];
    }
}
