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
            'document' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'order' => 'nullable|integer'
        ]);
 
        $basePath = is_dir($_SERVER['DOCUMENT_ROOT'] . '/uploads') ? $_SERVER['DOCUMENT_ROOT'] : public_path();
        $destinationPath = $basePath . '/uploads/policies';

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move($destinationPath, $fileName);
            $data['image'] = 'uploads/policies/' . $fileName;
        }

        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move($destinationPath, $fileName);
            $data['document'] = 'uploads/policies/' . $fileName;
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
            'document' => 'nullable|file|mimes:pdf,doc,docx|max:10240',
            'order' => 'nullable|integer'
        ]);
 
        if ($request->has('remove_image')) {
            if ($policy->image) {
                $this->deleteFile($policy->image);
            }
            $data['image'] = null;
        }

        $basePath = is_dir($_SERVER['DOCUMENT_ROOT'] . '/uploads') ? $_SERVER['DOCUMENT_ROOT'] : public_path();
        $destinationPath = $basePath . '/uploads/policies';

        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }

        if ($request->hasFile('image')) {
            if ($policy->image) {
                $this->deleteFile($policy->image);
            }

            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move($destinationPath, $fileName);
            $data['image'] = 'uploads/policies/' . $fileName;
        }

        if ($request->has('remove_document')) {
            if ($policy->document) {
                $this->deleteFile($policy->document);
            }
            $data['document'] = null;
        }

        if ($request->hasFile('document')) {
            if ($policy->document) {
                $this->deleteFile($policy->document);
            }

            $file = $request->file('document');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move($destinationPath, $fileName);
            $data['document'] = 'uploads/policies/' . $fileName;
        }
 
        $policy->update($data);
 
        return redirect()->route('admin.policies.index')->with('success', 'Policy updated successfully!');
    }
 
    public function destroy(Policy $policy)
    {
        if ($policy->image) {
            $this->deleteFile($policy->image);
        }
        
        if ($policy->document) {
            $this->deleteFile($policy->document);
        }

        $policy->delete();
        return redirect()->route('admin.policies.index')->with('success', 'Policy deleted successfully!');
    }

    private function deleteFile($path)
    {
        $basePath = is_dir($_SERVER['DOCUMENT_ROOT'] . '/uploads') ? $_SERVER['DOCUMENT_ROOT'] : public_path();
        
        // Remove storage/ prefix if it was added incorrectly
        $cleanPath = str_replace('storage/', '', $path);
        
        $fullPath = $basePath . '/' . $cleanPath;
        if (file_exists($fullPath)) {
            @unlink($fullPath);
        }
    }
}
