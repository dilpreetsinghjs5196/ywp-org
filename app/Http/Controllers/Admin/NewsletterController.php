<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Newsletter;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    public function index()
    {
        $newsletters = Newsletter::orderBy('year', 'desc')->orderBy('order', 'asc')->get();
        return view('admin.newsletters.index', compact('newsletters'));
    }

    public function create()
    {
        return view('admin.newsletters.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'year' => 'required|integer',
            'image' => 'nullable|image|max:2048',
            'file' => 'nullable|mimes:pdf,doc,docx|max:10240',
            'order' => 'nullable|integer'
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/uploads/newsletters/images';
            if (!file_exists($destinationPath)) mkdir($destinationPath, 0777, true);
            $file->move($destinationPath, $fileName);
            $data['image'] = 'uploads/newsletters/images/' . $fileName;
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/uploads/newsletters/docs';
            if (!file_exists($destinationPath)) mkdir($destinationPath, 0777, true);
            $file->move($destinationPath, $fileName);
            $data['file'] = 'uploads/newsletters/docs/' . $fileName;
        }

        Newsletter::create($data);

        return redirect()->route('admin.newsletters.index')->with('success', 'Newsletter added successfully!');
    }

    public function edit($id)
    {
        $newsletter = Newsletter::findOrFail($id);
        return view('admin.newsletters.edit', compact('newsletter'));
    }

    public function update(Request $request, $id)
    {
        $newsletter = Newsletter::findOrFail($id);
        $data = $request->validate([
            'title' => 'required',
            'year' => 'required|integer',
            'image' => 'nullable|image|max:2048',
            'file' => 'nullable|mimes:pdf,doc,docx|max:10240',
            'order' => 'nullable|integer'
        ]);

        if ($request->has('remove_image')) {
            if ($newsletter->image && file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $newsletter->image)) {
                @unlink($_SERVER['DOCUMENT_ROOT'] . '/' . $newsletter->image);
            }
            $data['image'] = null;
        }

        if ($request->hasFile('image')) {
            if ($newsletter->image && file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $newsletter->image)) {
                @unlink($_SERVER['DOCUMENT_ROOT'] . '/' . $newsletter->image);
            }
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/uploads/newsletters/images';
            if (!file_exists($destinationPath)) mkdir($destinationPath, 0777, true);
            $file->move($destinationPath, $fileName);
            $data['image'] = 'uploads/newsletters/images/' . $fileName;
        }

        if ($request->hasFile('file')) {
            if ($newsletter->file && file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $newsletter->file)) {
                @unlink($_SERVER['DOCUMENT_ROOT'] . '/' . $newsletter->file);
            }
            $file = $request->file('file');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/uploads/newsletters/docs';
            if (!file_exists($destinationPath)) mkdir($destinationPath, 0777, true);
            $file->move($destinationPath, $fileName);
            $data['file'] = 'uploads/newsletters/docs/' . $fileName;
        }

        $newsletter->update($data);

        return redirect()->route('admin.newsletters.index')->with('success', 'Newsletter updated successfully!');
    }

    public function destroy($id)
    {
        $newsletter = Newsletter::findOrFail($id);
        if ($newsletter->image && file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $newsletter->image)) {
            @unlink($_SERVER['DOCUMENT_ROOT'] . '/' . $newsletter->image);
        }
        if ($newsletter->file && file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $newsletter->file)) {
            @unlink($_SERVER['DOCUMENT_ROOT'] . '/' . $newsletter->file);
        }
        $newsletter->delete();
        return redirect()->route('admin.newsletters.index')->with('success', 'Newsletter deleted successfully!');
    }
}
