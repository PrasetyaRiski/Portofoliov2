<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $projectId = $this->route('project')?->id;

        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:projects,slug,' . $projectId],
            'category' => ['required', 'string', 'in:' . implode(',', array_keys(config('portfolio.projects.categories')))],
            'short_description' => ['nullable', 'string', 'max:500'],
            'description' => ['required', 'string'],
            'featured_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif,webp', 'max:5120'],
            'gallery_images' => ['nullable', 'array'],
            'gallery_images.*' => ['image', 'mimes:jpg,jpeg,png,gif,webp', 'max:5120'],
            'technologies' => ['nullable', 'string'],
            'demo_url' => ['nullable', 'url', 'max:255'],
            'github_url' => ['nullable', 'url', 'max:255'],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'client' => ['nullable', 'string', 'max:255'],
            'is_featured' => ['nullable', 'boolean'],
            'status' => ['required', 'in:draft,published,archived'],
            'order' => ['nullable', 'integer', 'min:0'],
            'removed_gallery_images' => ['nullable', 'array'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Project title is required.',
            'category.required' => 'Please select a category.',
            'description.required' => 'Project description is required.',
            'featured_image.image' => 'Featured image must be an image file.',
            'featured_image.max' => 'Featured image must be less than 5MB.',
            'gallery_images.*.image' => 'Gallery images must be image files.',
            'gallery_images.*.max' => 'Each gallery image must be less than 5MB.',
            'demo_url.url' => 'Please enter a valid demo URL.',
            'github_url.url' => 'Please enter a valid GitHub URL.',
            'end_date.after_or_equal' => 'End date must be after or equal to start date.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_featured' => $this->boolean('is_featured'),
        ]);
    }
}
