<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageContent extends Model
{
    protected $fillable = ['page', 'section', 'key', 'value', 'type'];

    public static function getValue($page, $section, $key)
    {
        return self::where('page', $page)
            ->where('section', $section)
            ->where('key', $key)
            ->value('value');
    }
}
