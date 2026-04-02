<?php
 
namespace App\Http\Controllers\Admin;
 
use App\Http\Controllers\Controller;
use App\Models\Policy;
use Illuminate\Http\Request;
 
class PolicyController extends Controller
{
    public function index()
    {
        $policies = Policy::orderBy('order')->latest()->get();
        return view('admin.policies.index', compact('policies'));
    }
 
    public function create()
    {
        return view('admin.policies.create');
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
            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/uploads/policies';
 
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
 
            $file->move($destinationPath, $fileName);
 
            $data['image'] = 'uploads/policies/' . $fileName;
        }
 
        Policy::create($data);
 
        return redirect()->route('admin.policies.index')->with('success', 'Policy created successfully!');
    }
 
    public function edit(Policy $policy)
    {
        return view('admin.policies.edit', compact('policy'));
    }
 
    public function update(Request $request, Policy $policy)
    {
        $data = $request->validate([
            'title' => 'required',
            'description' => 'nullable',
            'link' => 'nullable',
            'image' => 'nullable|image|max:2048',
            'order' => 'nullable|integer'
        ]);
 
        if ($request->has('remove_image')) {
            if ($policy->image && file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $policy->image)) {
                @unlink($_SERVER['DOCUMENT_ROOT'] . '/' . $policy->image);
            }
            $data['image'] = null;
        }

        if ($request->hasFile('image')) {
            // Delete old one if exists
            if ($policy->image && file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $policy->image)) {
                @unlink($_SERVER['DOCUMENT_ROOT'] . '/' . $policy->image);
            }

            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
 
            // Universal path (works local + server)
            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/uploads/policies';
 
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
 
            $file->move($destinationPath, $fileName);
 
            $data['image'] = 'uploads/policies/' . $fileName;
        }
 
        $policy->update($data);
 
        return redirect()->route('admin.policies.index')->with('success', 'Policy updated successfully!');
    }
 
    public function destroy(Policy $policy)
    {
        // Delete image from disk if exists
        if ($policy->image && file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $policy->image)) {
            @unlink($_SERVER['DOCUMENT_ROOT'] . '/' . $policy->image);
        }

        $policy->delete();
        return redirect()->route('admin.policies.index')->with('success', 'Policy deleted successfully!');
    }
}
