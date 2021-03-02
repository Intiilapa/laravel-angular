<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:users,name,'.$this->user->id.'|min:2|max:255',
            'email' => 'required|unique:users,email,'.$this->user->id.'|email|min:5|max:255',
            'role' => 'required|in:'.implode(',', array_keys(User::roles())),
        ];
    }
}
