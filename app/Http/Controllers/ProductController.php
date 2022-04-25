<?php

namespace App\Http\Controllers;

use App\Http\Form\AdminCustomValidator;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function __construct(AdminCustomValidator $form)
    {
        $this->form = $form;
    }

    public function index()
    {
        return view('product');
    }

    public function save(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'product_name'=>'required|string|unique:products',
            'product_img'=>'required|image',
        ],[
            'product_name.required'=>'Product name is required',
            'product_name.string'=>'Product name must be a string',
            'product_name.unique'=>'This product name is already taken',
            'product_img.required'=>'Product image is required',
            'product_img.image'=>'Product file must be an image',
        ]);
        // $validator = $this->form->validate($request, 'ValidateFormAddProduct');
        if(!$validator->passes()){
            return response()->json(['code'=>0,'error'=>$validator->errors()->toArray()]);
        }else{
            $path = 'files/';
            $file = $request->file('product_img');
            $file_name = time().'_'.$file->getClientOriginalName();

            // $upload = $file->storeAs($path, $file_name);
            $upload = $file->storeAs($path, $file_name, 'public');

            if($upload){
                Product::insert([
                    'product_name'=>$request->product_name,
                    'product_img'=>$file_name,
                ]);
                return response()->json(['code'=>1,'msg'=>'New product has been saved successfully']);
            }
        }
    }
}
