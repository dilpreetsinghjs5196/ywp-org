<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnnualReport;
use Illuminate\Http\Request;

class AnnualReportController extends Controller
{
    public function index()
    {
        $reports = AnnualReport::orderBy('order')->latest()->get();
        return view('admin.annual_reports.index', compact('reports'));
    }

    public function create()
    {
        return view('admin.annual_reports.create');
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
            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/uploads/annual_reports';

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $file->move($destinationPath, $fileName);
            $data['image'] = 'uploads/annual_reports/' . $fileName;
        }

        AnnualReport::create($data);

        return redirect()->route('admin.annual-reports.index')->with('success', 'Annual Report created successfully!');
    }

    public function edit($id)
    {
        $report = AnnualReport::findOrFail($id);
        return view('admin.annual_reports.edit', compact('report'));
    }

    public function update(Request $request, $id)
    {
        $report = AnnualReport::findOrFail($id);
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
            if ($report->image && file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $report->image)) {
                @unlink($_SERVER['DOCUMENT_ROOT'] . '/' . $report->image);
            }

            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/uploads/annual_reports';

            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }

            $file->move($destinationPath, $fileName);
            $data['image'] = 'uploads/annual_reports/' . $fileName;
        }

        $report->update($data);

        return redirect()->route('admin.annual-reports.index')->with('success', 'Annual Report updated successfully!');
    }

    public function destroy($id)
    {
        $report = AnnualReport::findOrFail($id);
        if ($report->image && file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $report->image)) {
            @unlink($_SERVER['DOCUMENT_ROOT'] . '/' . $report->image);
        }
        $report->delete();
        return redirect()->route('admin.annual-reports.index')->with('success', 'Annual Report deleted successfully!');
    }
}
