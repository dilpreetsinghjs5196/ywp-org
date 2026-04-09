<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\PageContent;

class PageContentController extends Controller
{
    public function index(Request $request)
    {
        $group = $request->get('group', 'home');
        
        $query = PageContent::select('page', 'section')->distinct();
        
        if ($group === 'about') {
            $query->whereIn('page', ['our-mission', 'history', 'advisory-board', 'on-board-professionals', 'gallery', 'faq']);
        } elseif ($group === 'recruitment_content') {
            $query->where('page', 'work-with-ywp');
        } else {
            $query->where('page', 'home');
        }

        $sections = $query->get()->groupBy('page');

        return view('admin.page-content.index', compact('sections', 'group'));
    }

    public function edit($page, $section)
    {
        $contents = PageContent::where('page', $page)
            ->where('section', $section)
            ->get();

        // Determine group for navigation
        $aboutPages = ['our-mission', 'history', 'advisory-board', 'on-board-professionals', 'gallery', 'faq'];
        if ($page === 'work-with-ywp') {
            $group = 'recruitment_content';
        } else {
            $group = in_array($page, $aboutPages) ? 'about' : 'home';
        }

        return view('admin.page-content.edit', compact('page', 'section', 'contents', 'group'));
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
        } elseif (in_array($section, ['faq', 'help_team', 'additional'])) {
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
        } elseif (in_array($section, ['rd_blogs', 'further_topics', 'references'])) {
            $validKeys = [];
            if ($section === 'rd_blogs') $prefix = 'idea';
            elseif ($section === 'further_topics') $prefix = 'topic';
            else $prefix = 'ref';
            
            if ($request->has('list_items')) {
                foreach ($request->list_items as $index => $itemValue) {
                    $key = "{$prefix}{$index}";
                    PageContent::updateOrCreate(
                        ['page' => $page, 'section' => $section, 'key' => $key],
                        ['value' => $itemValue ?? '', 'type' => 'text']
                    );
                    $validKeys[] = $key;
                }
            }
            PageContent::where('page', $page)->where('section', $section)->where('key', 'like', "{$prefix}%")->whereNotIn('key', $validKeys)->delete();
        } elseif ($section === 'members') {
            $validKeys = [];
            if ($request->has('members')) {
                foreach ($request->members as $index => $memberData) {
                    // Handle Name
                    $nameKey = "member{$index}_name";
                    PageContent::updateOrCreate(
                        ['page' => $page, 'section' => $section, 'key' => $nameKey],
                        ['value' => $memberData['name'] ?? '', 'type' => 'text']
                    );
                    $validKeys[] = $nameKey;

                    // Handle Description
                    $descKey = "member{$index}_desc";
                    PageContent::updateOrCreate(
                        ['page' => $page, 'section' => $section, 'key' => $descKey],
                        ['value' => $memberData['desc'] ?? '', 'type' => 'textarea']
                    );
                    $validKeys[] = $descKey;

                    // Handle Image
                    $imageKey = "member{$index}_image";
                    $existingImage = PageContent::where(['page' => $page, 'section' => $section, 'key' => $imageKey])->first();
                    
                    if ($request->hasFile("members.$index.image")) {
                        $file = $request->file("members.$index.image");
                        $fileName = time() . '_' . $index . '_' . $file->getClientOriginalName();
                        $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/uploads';
                        if (!file_exists($destinationPath)) {
                            mkdir($destinationPath, 0777, true);
                        }
                        $file->move($destinationPath, $fileName);
                        $imagePath = 'uploads/' . $fileName;
                    } else {
                        $imagePath = $existingImage->value ?? 'images/preeti.jpg';
                    }

                    PageContent::updateOrCreate(
                        ['page' => $page, 'section' => $section, 'key' => $imageKey],
                        ['value' => $imagePath, 'type' => 'image']
                    );
                    $validKeys[] = $imageKey;
                }
            }
            // Cleanup deleted members
            PageContent::where('page', $page)->where('section', $section)->where('key', 'like', 'member%')->whereNotIn('key', $validKeys)->delete();
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
