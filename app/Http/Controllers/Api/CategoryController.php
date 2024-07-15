<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request){
        $includeSkills = $request->query('skills');

        $category = Category::get();
        if($includeSkills){
            return new CategoryCollection($category->loadMissing(('skills')));
        }
        return new CategoryCollection($category);
    }

    public function show(Category $category){
        $includeSkills = request()->query('skills');

        if($includeSkills){
            return new CategoryResource($category->loadMissing('skills'));
        }

        return new CategoryResource($category);
    }
}
