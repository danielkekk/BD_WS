<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoriesController extends Controller
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
        $categories = DB::select("SELECT node.name
                                        FROM categories AS node,
                                        categories AS parent
                                        WHERE node.lft BETWEEN parent.lft AND parent.rgt
                                        AND parent.name = 'ELECTRONICS'
                                        ORDER BY node.lft;", []);

        return view('categories', ['categories' => $categories]);
    }
}
