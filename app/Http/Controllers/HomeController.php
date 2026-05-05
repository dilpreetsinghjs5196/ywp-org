<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\PageContent;
use App\Models\Campaign;
use App\Models\OnBoardProfessional;
use App\Models\Gallery;
use App\Models\Report;
use App\Models\Policy;
use App\Models\AnnualReport;
use App\Models\Newsletter;

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
        $policies = Policy::orderBy('order')->get();

        return view('home', compact('contents', 'campaigns', 'policies'));
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

    /**
     * Display Newsletters
     */
    public function newsletters(Request $request)
    {
        $query = Newsletter::query();

        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        $newsletters = $query->orderBy('year', 'desc')->orderBy('order', 'asc')->paginate(10);
        return view('newsletters', compact('newsletters'));
    }

    public function reports(Request $request)
    {
        $query = AnnualReport::query();

        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        $reports = $query->orderBy('order')->paginate(10);
        return view('reports', compact('reports'));
    }

    public function policies(Request $request)
    {
        $query = Policy::query();

        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        $policies = $query->orderBy('order')->paginate(10);
        return view('policies', compact('policies'));
    }

    public function researchPapers(Request $request)
    {
        $query = Report::query();

        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $reports = $query->orderBy('order')->paginate(10);
        return view('research-papers', compact('reports'));
    }
}
