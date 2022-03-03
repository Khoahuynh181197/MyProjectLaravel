<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BrandStoreRequest extends FormRequest
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
        // $this->validate($request,
        // [
            
        // ],
        // [
        //     'txtBrandName.required'     =>      'You must enter the brand name',
        //     'txtBrandName.min'          =>      'Brand name must be between 3 and 100 characters',
        //     'txtBrandName.max'          =>      'Brand name must be between 3 and 100 characters',
        //     'txtBrandName.unique'       =>      'This name already exists',
        // ]
        // );
        return [
            'txtBrandName'              =>      'required|min:3|max:100|unique:brands,name,$this->id,id',
        ];
    }
    public function messages()
    {
        return [
            'txtBrandName.required' => 'Brand name is required!',
            'txtBrandName.min' => 'Brand Name is between 3 and 100 characters',
            'txtBrandName.max' => 'Brand Name is between 3 and 100 characters',
            'txtBrandName.unique' => 'Brand name is unique',
        ];
    }
}
