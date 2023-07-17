<?php

namespace App\Http\Requests\DiaryArticle;

use App\Models\DiaryArticle;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDiaryArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $diaryArticle = DiaryArticle::findOrFail($this->route('diaryArticleId'));
        return $this->user()->can('crud', $diaryArticle);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'date' => 'required',
            'body' => 'required'
        ];
    }
}
