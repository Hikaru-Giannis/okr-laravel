<?php
declare(strict_types=1);

namespace App\Http\Requests\Target;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'target.contents' => 'required',
            'target.expiration_date' => 'required',
            'indicators.*' => 'required'
        ];
    }
}
