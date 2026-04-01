<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OnBoardProfessional;
use Illuminate\Http\Request;

class ProfessionalController extends Controller
{
    public function index()
    {
        $professionals = OnBoardProfessional::all();
        return view('admin.professionals.index', compact('professionals'));
    }

    public function create()
    {
        return view('admin.professionals.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_name' => 'required',
            'qualification' => 'nullable',
            'description' => 'nullable',
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/uploads/professionals';
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $file->move($destinationPath, $fileName);
            $data['photo'] = 'uploads/professionals/' . $fileName;
        }

        OnBoardProfessional::create($data);

        return redirect()->route('admin.professionals.index')->with('success', 'Professional added successfully');
    }

    public function edit(OnBoardProfessional $professional)
    {
        return view('admin.professionals.edit', compact('professional'));
    }

    public function update(Request $request, OnBoardProfessional $professional)
    {
        $request->validate([
            'user_name' => 'required',
            'qualification' => 'nullable',
            'description' => 'nullable',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($professional->photo && file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $professional->photo)) {
                @unlink($_SERVER['DOCUMENT_ROOT'] . '/' . $professional->photo);
            }

            $file = $request->file('photo');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/uploads/professionals';
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $file->move($destinationPath, $fileName);
            $data['photo'] = 'uploads/professionals/' . $fileName;
        }

        $professional->update($data);

        return redirect()->route('admin.professionals.index')->with('success', 'Professional updated successfully');
    }

    public function destroy(OnBoardProfessional $professional)
    {
        if ($professional->photo && file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $professional->photo)) {
            @unlink($_SERVER['DOCUMENT_ROOT'] . '/' . $professional->photo);
        }
        $professional->delete();
        return redirect()->route('admin.professionals.index')->with('success', 'Professional removed successfully');
    }
}
