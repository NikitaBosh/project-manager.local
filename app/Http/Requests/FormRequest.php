<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class FormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = User::find($this->route('user'));
        if (isset($contact)) {
            if (Auth::id() !== $user->user_id) {
                return false;
            }
        }
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
            'name' => 'required|max:255',
            'priority' => 'required|integer|between:1,3'
        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'Необходимо ввести название задачи',
            'name.max' => 'Название задачи должно быть короче :max символов',
            'priority.required' => 'Необходимо выбрать приоритет выполнения задачи',
            'priority.integer' => 'Приоритет должен быть целым числом',
            'priority.between' => 'Текущий приоритет :input. Ранг приоритета должен быть от :min до :max',
        ];
    }
