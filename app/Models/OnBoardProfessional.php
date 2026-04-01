<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OnBoardProfessional extends Model
{
    use HasFactory;

    protected $table = 'on_board_professionals';

    protected $fillable = [
        'user_name',
        'gender',
        'position',
        'qualification',
        'description',
        'photo'
    ];

    public $timestamps = false;
}
