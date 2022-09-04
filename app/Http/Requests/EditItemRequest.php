<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class EditItemRequest extends FormRequest
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
            //
            'item_img' => 'file|image|max:30000|mimes:jpeg,png,gif',
            'title' => 'required|max:100',
            'detail' => 'max:1000',

        ];
    }

    // 無料フラグが1ではない場合、値段のチェック
    public function withValidator(Validator $validator)
    {
        $validator->sometimes('price', 'required|numeric|between:100,999999', function ($input) {
            return $input->free_flg !== "1";
        });
    }
}
