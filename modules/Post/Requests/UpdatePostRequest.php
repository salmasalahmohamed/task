<?php

namespace Modules\Post\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    public function authorize()
    {
        return auth('admin')->check();
    }

    public function rules()
    {
        return [
            'title'        => 'sometimes|string|max:255',
            'content'      => 'sometimes|string',
            'status'       => 'sometimes|in:Draft,Scheduled,Published',
            'published_at' => 'nullable|date',
            'category_id'  => 'sometimes|exists:categories,id',
        ];
    }
}
