<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends WebController
{
    public function show($id){
        $data['cat'] = Category::findOrFail($id);
        $data['allCats'] = Category::select('id','name')->active()->get();

        $data['skills'] = $data['cat']->skills()->active()->paginate(6);

        return view('web.categories.show')->with($data);
    }
}