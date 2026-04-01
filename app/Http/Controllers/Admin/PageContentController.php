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
        $page = $request->page;
        $section = $request->section;

        if ($section === 'hero') {
            // Special handling for Hero Slides
            $validKeys = [];
            if ($request->has('slides')) {
                foreach ($request->slides as $index => $slideData) {
                    // Handle Title
                    $titleKey = "slide{$index}_title";
                    PageContent::updateOrCreate(
                        ['page' => $page, 'section' => $section, 'key' => $titleKey],
                        ['value' => $slideData['title'] ?? '', 'type' => 'textarea']
                    );
                    $validKeys[] = $titleKey;

                    // Handle Subtitle
                    $subtitleKey = "slide{$index}_subtitle";
                    PageContent::updateOrCreate(
                        ['page' => $page, 'section' => $section, 'key' => $subtitleKey],
                        ['value' => $slideData['subtitle'] ?? '', 'type' => 'text']
                    );
                    $validKeys[] = $subtitleKey;

                    // Handle Image
                    $imageKey = "slide{$index}_image";
                    $existingImage = PageContent::where(['page' => $page, 'section' => $section, 'key' => $imageKey])->first();
                    
                    if ($request->hasFile("slides.$index.image")) {
                        $file = $request->file("slides.$index.image");
                        $fileName = time() . '_' . $index . '_' . $file->getClientOriginalName();
                        
                        $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/uploads';
                        if (!file_exists($destinationPath)) {
                            mkdir($destinationPath, 0777, true);
                        }
                        $file->move($destinationPath, $fileName);

                        $imagePath = 'uploads/' . $fileName;
                    } else {
                        $imagePath = $existingImage->value ?? 'images/slider-main-1.jpg';
                    }

                    PageContent::updateOrCreate(
                        ['page' => $page, 'section' => $section, 'key' => $imageKey],
                        ['value' => $imagePath, 'type' => 'image']
                    );
                    $validKeys[] = $imageKey;
                }
            }

            // Cleanup
            PageContent::where('page', $page)->where('section', $section)->where('key', 'like', 'slide%')->whereNotIn('key', $validKeys)->delete();

        } elseif ($section === 'we_believe') {
            $validKeys = ['tagline', 'title'];
            if ($request->has('icons')) {
                foreach ($request->icons as $index => $iconData) {
                    $keys = ['title' => 'text', 'link' => 'text', 'class' => 'text'];
                    foreach ($keys as $suffix => $type) {
                        $key = "icon{$index}_{$suffix}";
                        PageContent::updateOrCreate(
                            ['page' => $page, 'section' => $section, 'key' => $key],
                            ['value' => $iconData[$suffix] ?? '', 'type' => $type]
                        );
                        $validKeys[] = $key;
                    }
                }
            }
            PageContent::where('page', $page)->where('section', $section)->where('key', 'like', 'icon%')->whereNotIn('key', $validKeys)->delete();
        } elseif ($section === 'faq') {
            $validKeys = [];
            if ($request->has('faqs')) {
                foreach ($request->faqs as $index => $faqData) {
                    // Question
                    $qKey = "faq{$index}_question";
                    PageContent::updateOrCreate(
                        ['page' => $page, 'section' => $section, 'key' => $qKey],
                        ['value' => $faqData['question'] ?? '', 'type' => 'text']
                    );
                    $validKeys[] = $qKey;

                    // Answer
                    $aKey = "faq{$index}_answer";
                    PageContent::updateOrCreate(
                        ['page' => $page, 'section' => $section, 'key' => $aKey],
                        ['value' => $faqData['answer'] ?? '', 'type' => 'textarea']
                    );
                    $validKeys[] = $aKey;
                }
            }
            PageContent::where('page', $page)->where('section', $section)->where('key', 'like', 'faq%')->whereNotIn('key', $validKeys)->delete();
        }

        if ($request->has('values')) {
            // Standard handling for fixed fields
            foreach ($request->values as $id => $value) {
                $content = PageContent::findOrFail($id);

                if ($content->type === 'image' && $request->hasFile("values.$id")) {
                    $file = $request->file("values.$id");
                    $fileName = time() . '_' . $file->getClientOriginalName();

                    $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/uploads';
                    if (!file_exists($destinationPath)) {
                        mkdir($destinationPath, 0777, true);
                    }
                    $file->move($destinationPath, $fileName);

                    $content->update(['value' => 'uploads/' . $fileName]);
                } else {
                    $content->update(['value' => $value]);
                }
            }
        }

        return back()->with('success', 'Content updated successfully!');
    }
}
