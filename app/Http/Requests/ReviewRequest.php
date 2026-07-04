<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'rating.required' => 'Vui lòng chọn đánh giá',
            'rating.integer' => 'Đánh giá phải là số nguyên',
            'rating.min' => 'Đánh giá phải từ 1 đến 5 sao',
            'rating.max' => 'Đánh giá phải từ 1 đến 5 sao',
            'comment.string' => 'Bình luận phải là chuỗi ký tự',
            'comment.max' => 'Bình luận tối đa 1000 ký tự',
        ];
    }
}
