<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RecruitmentApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class RecruitmentController extends Controller
{
    public function index()
    {
        $applications = RecruitmentApplication::latest()->paginate(10);
        return view('admin.recruitment.index', compact('applications'));
    }

    public function show($id)
    {
        $application = RecruitmentApplication::findOrFail($id);
        return view('admin.recruitment.show', compact('application'));
    }

    public function update(Request $request, $id)
    {
        $application = RecruitmentApplication::findOrFail($id);
        $application->update([
            'status' => $request->status
        ]);

        return redirect()->route('admin.recruitment.index')->with('success', 'Application status updated successfully.');
    }

    public function destroy($id)
    {
        $application = RecruitmentApplication::findOrFail($id);
        
        if ($application->cv_path) {
            Storage::disk('public')->delete($application->cv_path);
        }

        $application->delete();

        return redirect()->route('admin.recruitment.index')->with('success', 'Application deleted successfully.');
    }
}
