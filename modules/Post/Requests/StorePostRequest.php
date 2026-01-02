<?php

namespace Modules\Post\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    public function authorize()
    {
        return auth('admin')->check();
    }

    public function rules()
    {
        return [
            'title'        => 'required|string|max:255',
            'content'      => 'required|string',
            'status'       => 'required|in:Draft,Scheduled,Published',
            'published_at' => 'nullable|date',
            'category_id'  => 'required|exists:categories,id',
        ];
    }
}
