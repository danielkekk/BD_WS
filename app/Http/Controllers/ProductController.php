<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::all();

        return view('product', ['products' => $products]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:255'],
            'qty' => ['required', 'integer'],
        ]);
    }

    /**
     * Create a new product instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Product
     */
    protected function create(Request $request)
    {
        $messages = [
            'required' => 'A :attribute mező kitöltése kötelező.',
            'max:20' => 'A hossz csak 20 lehet.',
            'integer' => 'Csak számok.',
        ];

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:20',
            'code' => 'required|string|max:20',
            'qty' => 'required|integer',
        ], $messages);

        if ($validator->fails()) {
            return redirect('products')
                ->withErrors($validator)
                ->withInput();
        }

        $product = new Product();
        $product->name = $request->name;
        $product->code = $request->code;
        $product->qty = $request->qty;
        $product->save();


        return redirect()->route('products');
    }
}
