<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'is_published' => $this->has('is_published') ? 1 : 0,
            'slug' => $this->slug ?: \Illuminate\Support\Str::slug($this->title),
        ]);
    }

    public function rules(): array
    {
        $articleId = $this->route('article')?->id;

        return [
            'company_id' => 'required|exists:companies,id',
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:articles,slug,' . $articleId,
            'excerpt' => 'nullable|string|max:500',
            'content' => 'nullable|string',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:3072',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
        ];
    }

    public function messages(): array
    {
        return [
            'company_id.required' => 'Selectați o companie.',
            'company_id.exists' => 'Compania selectată nu există.',
            'title.required' => 'Titlul articolului este obligatoriu.',
            'slug.unique' => 'Acest slug este deja folosit.',
            'cover_image.image' => 'Fișierul trebuie să fie o imagine.',
            'cover_image.max' => 'Imaginea nu poate depăși 3MB.',
        ];
    }
}
