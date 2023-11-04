<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'question' => 'required',
            'test_id' => 'required',
            'img' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg,webp|max:2548',
            'number_correct_answer' => 'required',
            'answers' => 'required',
        ];
    }
}
