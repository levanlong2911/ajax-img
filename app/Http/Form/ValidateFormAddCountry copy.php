<?php

namespace App\Http\Form;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ValidateFormAddCountry
{
    /**
     * validate
     *
     * @param \Illuminate\Http\Request $request
     */

    public function validate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|min:6|max:32',
        ],[
            'name.required' => 'Vui lòng nhập name',
            'name.min' => 'Vui lòng nhập password ít nhất 6 ký tự',
            'name.max' => 'Vui lòng nhập password nhiều nhất 32 ký tự'
        ]);
        // cho edit eamil
        return $validator->validate();
    }
}
