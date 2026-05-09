<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SkillRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $skillId = $this->route('skill')?->id;

        return [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:skills,slug,' . $skillId],
            'category' => ['required', 'string', 'in:' . implode(',', array_keys(config('portfolio.skills.categories')))],
            'level' => ['required', 'integer', 'min:1', 'max:100'],
            'icon' => ['nullable', 'string', 'max:255'],
            'color' => ['nullable', 'string', 'max:20'],
            'description' => ['nullable', 'string', 'max:500'],
            'years_experience' => ['nullable', 'integer', 'min:0', 'max:50'],
            'is_featured' => ['nullable', 'boolean'],
            'order' => ['nullable', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Skill name is required.',
            'category.required' => 'Please select a category.',
            'level.required' => 'Skill level is required.',
            'level.min' => 'Skill level must be at least 1.',
            'level.max' => 'Skill level cannot exceed 100.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_featured' => $this->boolean('is_featured'),
        ]);
    }
}
