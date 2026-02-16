<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_active' => $this->has('is_active') ? 1 : 0,
            'slug' => $this->slug ?: \Illuminate\Support\Str::slug($this->name),
        ]);
    }

    public function rules(): array
    {
        $companyId = $this->route('company')?->id;

        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:companies,slug,' . $companyId,
            'description' => 'nullable|string',
            'logo' => ($this->isMethod('post') ? 'nullable' : 'nullable') . '|image|mimes:jpg,jpeg,png,webp,svg|max:2048',
            'website' => 'nullable|url|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:50',
            'address' => 'nullable|string|max:500',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Numele companiei este obligatoriu.',
            'slug.unique' => 'Acest slug este deja folosit.',
            'logo.image' => 'Logo-ul trebuie să fie o imagine.',
            'logo.max' => 'Logo-ul nu poate depăși 2MB.',
            'website.url' => 'Introduceți un URL valid.',
            'email.email' => 'Introduceți un email valid.',
        ];
    }
}
