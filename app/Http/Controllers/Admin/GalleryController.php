<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $images = Gallery::orderBy('sort_order', 'asc')->get();
        return view('admin.gallery.index', compact('images'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'title' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer'
        ]);

        $data = $request->except('_token');

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/uploads/gallery';
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $file->move($destinationPath, $fileName);
            $data['image'] = 'uploads/gallery/' . $fileName;
        }

        Gallery::create($data);

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery image added successfully');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
            'title' => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active' => 'required|boolean'
        ]);

        $data = $request->except(['_token', '_method']);

        if ($request->hasFile('image')) {
            // Delete old photo if exists
            if ($gallery->image && file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $gallery->image)) {
                @unlink($_SERVER['DOCUMENT_ROOT'] . '/' . $gallery->image);
            }

            $file = $request->file('image');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/uploads/gallery';
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $file->move($destinationPath, $fileName);
            $data['image'] = 'uploads/gallery/' . $fileName;
        }

        $gallery->update($data);

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item updated successfully');
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->image && file_exists($_SERVER['DOCUMENT_ROOT'] . '/' . $gallery->image)) {
            @unlink($_SERVER['DOCUMENT_ROOT'] . '/' . $gallery->image);
        }
        $gallery->delete();
        return redirect()->route('admin.gallery.index')->with('success', 'Gallery image removed successfully');
    }
}
