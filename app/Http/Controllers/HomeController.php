<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PageContent;
use App\Models\Campaign;

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

        $campaigns = Campaign::all();

        return view('home', compact('contents', 'campaigns'));
    }

    public function ourMission()
    {
        $contents = PageContent::where('page', 'our-mission')
            ->get()
            ->groupBy('section')
            ->mapWithKeys(function ($items, $section) {
                return [$section => $items->pluck('value', 'key')];
            });

        return view('our-mission', compact('contents'));
    }
}
