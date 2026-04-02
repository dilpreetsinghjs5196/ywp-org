<?php
 
namespace App\Http\Controllers\Admin;
 
use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
 
class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::orderBy('order')->latest()->get();
        return view('admin.reports.index', compact('reports'));
    }
 
    public function create()
    {
        return view('admin.reports.create');
    }
 
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'link' => 'nullable',
            'image' => 'nullable|image|max:2048',
            'order' => 'nullable|integer'
        ]);
 
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
 
            // Universal path (works local + server)
            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/uploads/reports';
 
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
 
            $file->move($destinationPath, $fileName);
 
            $data['image'] = 'uploads/reports/' . $fileName;
        }
 
        Report::create($data);
 
        return redirect()->route('admin.reports.index')->with('success', 'Report created successfully!');
    }
 
    public function edit(Report $report)
    {
        return view('admin.reports.edit', compact('report'));
    }
 
    public function update(Request $request, Report $report)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'link' => 'nullable',
            'image' => 'nullable|image|max:2048',
            'order' => 'nullable|integer'
        ]);
 
        if ($request->has('remove_image')) {
            if ($report->image && file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $report->image)) {
                @unlink($_SERVER['DOCUMENT_ROOT'] . '/' . $report->image);
            }
            $data['image'] = null;
        }

        if ($request->hasFile('image')) {
            // Delete old one if exists
            if ($report->image && file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $report->image)) {
                @unlink($_SERVER['DOCUMENT_ROOT'] . '/' . $report->image);
            }

            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();

            // Universal path (works local + server)
            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/uploads/reports';

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $file->move($destinationPath, $fileName);

            $data['image'] = 'uploads/reports/' . $fileName;
        }
 
        $report->update($data);
 
        return redirect()->route('admin.reports.index')->with('success', 'Report updated successfully!');
    }
 
    public function destroy(Report $report)
    {
        $report->delete();
        return redirect()->route('admin.reports.index')->with('success', 'Report deleted successfully!');
    }
}
