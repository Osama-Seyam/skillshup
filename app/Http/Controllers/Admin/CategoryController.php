<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

class CategoryController extends controller
{
    public function index(){
        $data['categories'] = Category::orderBy('id','Desc')->paginate(8);
        return view('admin.categories.index')->with($data);
    }

    public function store(Request $request){
       $request->validate([
            'name_en'=>'required|string|max:50',
            'name_ar'=>'required|string|max:50',
       ]);

       Category::create([
            'name'=>json_encode([
                'en'=>$request->name_en,
                'ar'=> $request->name_ar,
            ]),
        ]);

        session()->flash('msg','The Category was added successfully');
        return back();
    }

    public function update(Request $request){
        $request->validate([
            'id'=>'required|exists:categories,id',
             'name_en'=>'required|string|max:50',
             'name_ar'=>'required|string|max:50',
        ]);

        Category::findOrFail($request->id)->update([
             'name'=>json_encode([
                 'en'=>$request->name_en,
                 'ar'=> $request->name_ar,
             ]),
         ]);

        session()->flash('msg','The Category was updated successfully');
         return back();
     }

     public function toggle(Category $category){
        $category->update([
            'active'=> !$category->active,
        ]);
        return back();
     }

     public function destroy(Category $category){
        try{
            $category->delete();
            $msg = "The Category wa deleted successfully";
        }catch(Exception $e){
            $msg = "Can't delete this category";
        }

        session()->flash('msg',$msg);
        return back();
    }
}
