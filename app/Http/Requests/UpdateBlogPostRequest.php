<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'blog_category_id' => 'required|exists:blog_categories,id',
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'photo' => 'nullable|image|max:2048',
            'published_at' => 'required|date',
            'tags' => 'nullable|string',
            'content' => 'required|string',
            'status' => 'required|in:publish,draft',
            'is_editors_choice' => 'nullable|boolean',
            'gallery' => 'nullable|array',
            'gallery.*' => 'image|max:2048',
        ];
    }
}
