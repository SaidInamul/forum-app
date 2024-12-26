<?php

namespace App\Http\Requests;

use App\Models\Topic;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreDiscussionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user()->can('create', Discussion::class);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'title' => ['required', 'max:255'],
            'body' => ['required', 'max:255'],
            'topic' => ['required', Rule::exists(Topic::class, 'id')]
        ];
    }
}
