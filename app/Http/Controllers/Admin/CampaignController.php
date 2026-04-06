<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\CampaignImage;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index()
    {
        $campaigns = Campaign::latest()->get();
        return view('admin.campaigns.index', compact('campaigns'));
    }

    public function create()
    {
        return view('admin.campaigns.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'category' => 'nullable',
            'description' => 'nullable',
            'link' => 'nullable',
            'image' => 'nullable|image|max:2048',
            'images.*' => 'nullable|image|max:2048'
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_thumb_' . $file->getClientOriginalName();
            $destinationPath = public_path('uploads/campaigns');
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
            $file->move($destinationPath, $fileName);
            $data['image'] = 'uploads/campaigns/' . $fileName;
        }

        $campaign = Campaign::create($data);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_thumb_' . $file->getClientOriginalName();
        
            if (is_dir($_SERVER['DOCUMENT_ROOT'] . '/uploads')) {
                $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/uploads/campaigns';
            } else {
                $destinationPath = public_path('uploads/campaigns');
            }
        
            if (!file_exists($destinationPath)) {
                mkdir($destinationPath, 0777, true);
            }
        
            $file->move($destinationPath, $fileName);
        
            $data['image'] = 'uploads/campaigns/' . $fileName;
        }

        return redirect()->route('admin.campaigns.index')->with('success', 'Campaign created successfully!');
    }

    public function edit(Campaign $campaign)
    {
        return view('admin.campaigns.edit', compact('campaign'));
    }

   public function update(Request $request, Campaign $campaign)
    {
        $data = $request->validate([
            'title' => 'required',
            'category' => 'nullable',
            'description' => 'nullable',
            'link' => 'nullable',
            'image' => 'nullable|image|max:2048',
            'images.*' => 'nullable|image|max:2048'
        ]);
    
        // 🔥 Detect correct upload path (local + live)
        if (is_dir($_SERVER['DOCUMENT_ROOT'] . '/uploads')) {
            $destinationPath = $_SERVER['DOCUMENT_ROOT'] . '/uploads/campaigns';
        } else {
            $destinationPath = public_path('uploads/campaigns');
        }
    
        // Create folder if not exists
        if (!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }
    
        // ✅ Single Image Upload
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = time() . '_thumb_' . $file->getClientOriginalName();
    
            $file->move($destinationPath, $fileName);
    
            $data['image'] = 'uploads/campaigns/' . $fileName;
        }
    
        // Update campaign
        $campaign->update($data);
    
        // ✅ Multiple Images Upload
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $fileName = time() . '_' . uniqid() . '_' . $file->getClientOriginalName();
    
                $file->move($destinationPath, $fileName);
    
                $campaign->images()->create([
                    'image_path' => 'uploads/campaigns/' . $fileName
                ]);
            }
        }
    
        return redirect()->route('admin.campaigns.index')
            ->with('success', 'Campaign updated successfully!');
    }
    
   public function destroy(Campaign $campaign)
    {
        // 🔥 Detect correct base path
        $basePath = is_dir($_SERVER['DOCUMENT_ROOT'] . '/uploads')
            ? $_SERVER['DOCUMENT_ROOT']
            : public_path();
    
        // ✅ Delete main thumbnail
        if ($campaign->image) {
            $path = $basePath . '/' . $campaign->image;
            if (file_exists($path)) {
                unlink($path);
            }
        }
    
        // ✅ Delete all gallery images
        foreach ($campaign->images as $img) {
            $path = $basePath . '/' . $img->image_path;
            if (file_exists($path)) {
                unlink($path);
            }
            $img->delete();
        }
    
        // ✅ Delete campaign
        $campaign->delete();
    
        return redirect()->route('admin.campaigns.index')
            ->with('success', 'Campaign deleted successfully!');
    }

    public function deleteImage($id)
    {
        $image = CampaignImage::findOrFail($id);
    
        // 🔥 Detect correct base path
        $basePath = is_dir($_SERVER['DOCUMENT_ROOT'] . '/uploads')
            ? $_SERVER['DOCUMENT_ROOT']
            : public_path();
    
        $path = $basePath . '/' . $image->image_path;
    
        if (file_exists($path)) {
            unlink($path);
        }
    
        $image->delete();
    
        return back()->with('success', 'Image removed successfully!');
    }
}
