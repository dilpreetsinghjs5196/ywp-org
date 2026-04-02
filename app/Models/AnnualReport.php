<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnnualReport extends Model
{
    protected $fillable = ['title', 'description', 'image', 'link', 'order'];
}
