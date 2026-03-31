<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PageContent;

class HomeController extends Controller
{
    public function index()
    {
        $contents = PageContent::where('page', 'home')
            ->get()
            ->groupBy('section')
            ->mapWithKeys(function ($items, $section) {
                return [$section => $items->pluck('value', 'key')];
            });

        return view('home', compact('contents'));
    }
}
