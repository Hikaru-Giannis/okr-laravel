<?php

namespace App\Http\Requests\Target;

use Illuminate\Foundation\Http\FormRequest;

class EvaluateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $user = $this->user();
        if (is_null($user)) {
            return false;
        }

        $this->merge(['user' => $user]);

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
            'target_id' => ['required', 'integer'],
            'indicators.*.indicator_id' => ['required', 'integer'],
            'indicators.*.score' => ['required', 'numeric', 'between:0,1'],
        ];
    }
}
