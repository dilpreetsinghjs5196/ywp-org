<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PageContent;
use App\Models\Campaign;
use App\Models\OnBoardProfessional;
use App\Models\Gallery;

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

    public function history()
    {
        $contents = PageContent::where('page', 'history')
            ->get()
            ->groupBy('section')
            ->mapWithKeys(function ($items, $section) {
                return [$section => $items->pluck('value', 'key')];
            });

        return view('history', compact('contents'));
    }

    public function advisoryBoard()
    {
        $contents = PageContent::where('page', 'advisory-board')
            ->get()
            ->groupBy('section')
            ->mapWithKeys(function ($items, $section) {
                return [$section => $items->pluck('value', 'key')];
            });

        return view('advisory-board', compact('contents'));
    }

    public function professionals()
    {
        $contents = PageContent::where('page', 'on-board-professionals')
            ->get()
            ->groupBy('section')
            ->mapWithKeys(function ($items, $section) {
                return [$section => $items->pluck('value', 'key')];
            });

        $professionals = OnBoardProfessional::all();
        return view('on-board-professionals', compact('professionals', 'contents'));
    }

    public function gallery()
    {
        $contents = PageContent::where('page', 'gallery')
            ->get()
            ->groupBy('section')
            ->mapWithKeys(function ($items, $section) {
                return [$section => $items->pluck('value', 'key')];
            });

        $images = Gallery::where('is_active', true)->orderBy('sort_order', 'asc')->get();
        return view('gallery', compact('images', 'contents'));
    }

    public function faq()
    {
        $contents = PageContent::where('page', 'faq')
            ->get()
            ->groupBy('section')
            ->mapWithKeys(function ($items, $section) {
                return [$section => $items->pluck('value', 'key')];
            });

        return view('faq', compact('contents'));
    }
}
