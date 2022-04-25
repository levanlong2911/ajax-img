<?php

namespace App\Http\Form;

use Illuminate\Http\Request;

/**
 * AdminCustomValidator
 * This call a form validator class
 */
class AdminCustomValidator
{
    /**
     * validate
     *
     * @param array  $request
     * @param string $class
     *
     * @return JSON || boolean
     */
    public function validate(Request $request, string $class)
    {
        // Declare object
        $formValidator = str_replace("{{$class}}", $class, "\App\Http\Form\{$class}");
        $formValidator = new $formValidator();
        // Validate inputs
        $error = $formValidator->validate($request);

        return $error;
    }
}