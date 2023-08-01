<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Auth;
use Illuminate\Foundation\Http\FormRequest;

class StoreListingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'title' => 'required|max:150',
            'company' => 'required|max:150',
            'location' => 'required',
            'salary' => 'required',
            'contract_type' => 'required|in:full-time, part-time',
            'tags' => 'required',
            'apply_link' => 'required|url',
            'payment_method_id' => 'required',
            'content' => 'required',
            'logo' => 'file|max:2048'
        ];

        if ( ! Auth::check()) {
            $rules = array_merge($rules, [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|confirmed|min:8|max:32'
            ]);
        }

        return $rules;
    }
}
