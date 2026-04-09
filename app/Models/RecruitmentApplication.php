<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecruitmentApplication extends Model
{
    protected $fillable = [
        'full_name',
        'email',
        'age',
        'phone',
        'how_did_you_hear_about_us',
        'department_preference_1',
        'department_preference_2',
        'department_preference_3',
        'other_department_interests',
        'motivation',
        'mental_health_views',
        'other_info',
        'previous_participation',
        'diversity_info',
        'cv_path',
        'status',
    ];
}
