<?php

namespace App\Http\Requests\DiaryArticle;

use App\Models\Diary;
use Illuminate\Foundation\Http\FormRequest;

class CreateDiaryArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $diary = Diary::findOrFail($this->route('diaryId'));
        return $this->user()->can('crud', $diary);
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
