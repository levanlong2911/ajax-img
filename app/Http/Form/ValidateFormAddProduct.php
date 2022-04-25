<?php

namespace App\Http\Form;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ValidateFormAddProduct
{
    /**
     * validate
     *
     * @param \Illuminate\Http\Request $request
     */

    public function validate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_name' => 'required',
            'product_img' => 'required',
        ],[
            'product_name.required' => 'Vui lòng nhập name',
            'product_img.required' => 'Vui lòng nhập capital_city',
        ]);
        // cho edit eamil
        return $validator->validate();
    }
}
