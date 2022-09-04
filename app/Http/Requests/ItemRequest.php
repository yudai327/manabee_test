<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class ItemRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;

        // if($this->path() === 'item/regist'){
        //     return true;
        // } elseif ($this->path() === 'item/edit') {
        //     return true;
        // }else{
        //     return false;
        // }

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return  [
            'video' => 'required|file|max:1000000|mimes:mp4,qt,x-ms-wmv,mpeg,x-msvideo',
            'item_img' => 'file|image|max:30000|mimes:jpeg,png,gif',
            'title' => 'required|max:100',
            'detail' => 'max:1000',
        ];
    }
    public function withValidator(Validator $validator)
    {

        $validator->sometimes('price', 'required|numeric|between:100,999999', function ($input) {
            return !isset($input->free_flg);
        });
    }
}
