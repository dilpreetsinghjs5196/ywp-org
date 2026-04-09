<?php

namespace App\Http\Controllers;

use App\Models\RecruitmentApplication;
use App\Models\PageContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RecruitmentController extends Controller
{
    public function index()
    {
        $contents = PageContent::where('page', 'work-with-ywp')->get()->groupBy('section')->map(function ($section) {
            return $section->pluck('value', 'key');
        });

        return view('work-with-ywp', compact('contents'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'age' => 'required|string',
            'phone' => 'required|string',
            'hear' => 'required|string',
            'Preference1' => 'nullable|string',
            'Preference2' => 'nullable|string',
            'Preference3' => 'nullable|string',
            'ans1' => 'nullable|string',
            'ans2' => 'nullable|string',
            'ans3' => 'nullable|string',
            'ans4' => 'nullable|string',
            'checkbox1' => 'nullable|string',
            'checkbox2' => 'nullable|string',
            'myfile' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        if ($request->hasFile('myfile')) {
            $path = $request->file('myfile')->store('recruitment/cvs', 'public');
            $validated['cv_path'] = $path;
        }

        // Map request names to database column names
        $applicationData = [
            'full_name' => $validated['name'],
            'email' => $validated['email'],
            'age' => $validated['age'],
            'phone' => $validated['phone'],
            'how_did_you_hear_about_us' => $validated['hear'],
            'department_preference_1' => $validated['Preference1'],
            'department_preference_2' => $validated['Preference2'],
            'department_preference_3' => $validated['Preference3'],
            'other_department_interests' => $validated['ans1'],
            'motivation' => $validated['ans2'],
            'mental_health_views' => $validated['ans3'],
            'other_info' => $validated['ans4'],
            'previous_participation' => $validated['checkbox1'],
            'diversity_info' => $validated['checkbox2'],
            'cv_path' => $validated['cv_path'] ?? null,
        ];

        RecruitmentApplication::create($applicationData);

        return redirect()->back()->with('success', 'Your info submitted successfully.');
    }
}
