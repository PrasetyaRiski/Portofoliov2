<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CertificateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $certificateId = $this->route('certificate')?->id;

        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', 'unique:certificates,slug,' . $certificateId],
            'issuer' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'in:' . implode(',', array_keys(config('portfolio.certificates.categories')))],
            'description' => ['nullable', 'string'],
            'issue_date' => ['nullable', 'date'],
            'expiry_date' => ['nullable', 'date', 'after:issue_date'],
            'credential_id' => ['nullable', 'string', 'max:255'],
            'credential_url' => ['nullable', 'url', 'max:255'],
            'logo' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif,webp,svg', 'max:2048'],
            'certificate_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,gif,webp', 'max:5120'],
            'skills_covered' => ['nullable', 'string'],
            'is_verified' => ['nullable', 'boolean'],
            'is_featured' => ['nullable', 'boolean'],
            'order' => ['nullable', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Certificate title is required.',
            'issuer.required' => 'Issuing organization is required.',
            'category.required' => 'Please select a category.',
            'expiry_date.after' => 'Expiry date must be after issue date.',
            'credential_url.url' => 'Please enter a valid credential URL.',
            'logo.image' => 'Logo must be an image file.',
            'logo.max' => 'Logo must be less than 2MB.',
            'certificate_image.image' => 'Certificate image must be an image file.',
            'certificate_image.max' => 'Certificate image must be less than 5MB.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_verified' => $this->boolean('is_verified'),
            'is_featured' => $this->boolean('is_featured'),
            'issue_date' => $this->issue_date ?? now()->format('Y-m-d'),
        ]);
    }
}
