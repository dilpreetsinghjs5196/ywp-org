<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PageContent;

class PageContentController extends Controller
{
    public function index()
    {
        $sections = PageContent::select('page', 'section')
            ->distinct()
            ->get()
            ->groupBy('page');

        return view('admin.page-content.index', compact('sections'));
    }

    public function edit($page, $section)
    {
        $contents = PageContent::where('page', $page)
            ->where('section', $section)
            ->get();

        return view('admin.page-content.edit', compact('page', 'section', 'contents'));
    }

    public function update(Request $request)
    {
        foreach ($request->values as $id => $value) {
            $content = PageContent::findOrFail($id);

            if ($content->type === 'image' && $request->hasFile("values.$id")) {
                $file = $request->file("values.$id");
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('uploads'), $fileName);
                $content->update(['value' => 'uploads/' . $fileName]);
            } else {
                $content->update(['value' => $value]);
            }
        }

        return back()->with('success', 'Content updated successfully!');
    }
}
