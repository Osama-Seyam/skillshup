<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Skill;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class SkillController extends controller
{
    public function index(){
        $data['skills'] = Skill::orderBy('id','Desc')->paginate(8);
        $categories = Category::select('id','name')->get();
        $data['categories'] = $this->formArray($categories);

        return view('admin.skills.index')->with($data);
    }

    public function store(Request $request){
        $request->validate([
             'name_en'=>'required|string|max:50',
             'name_ar'=>'required|string|max:50',
             'img'=> 'required|image',
             'category_id'=> 'required|exists:categories,id'
        ]);

        $path = request()->file('img')->store('skills');

        Skill::create([
             'name'=>json_encode([
                 'en'=>$request->name_en,
                 'ar'=> $request->name_ar,
             ]),
             'img'=>$path,
             'category_id' => $request->category_id,
         ]);

         session()->flash('msg','The Skill was added successfully');
         return back();
     }

     public function update(Request $request){
        $request->validate([
            'id' => 'required|exists:skills,id',
            'name_en' => 'required|string|max:50',
            'name_ar' => 'required|string|max:50',
            'img' => 'nullable|image',
            'category_id' => 'required|exists:categories,id'
       ]);

        $skill = Skill::findOrFail($request->id);
        $path = $skill->img;

        if($request->hasFile('img')){
            Storage::delete($path);
            $path = request()->file('img')->store('skills');
        }

        $skill->update([
              'name'=>json_encode([
                  'en'=>$request->name_en,
                  'ar'=> $request->name_ar,
              ]),
              'img'=>$path,
             'category_id' => $request->category_id,
          ]);

         session()->flash('msg','The Skill was updated successfully');
          return back();
      }

    public function toggle(Skill $skill){
        $skill->update([
            'active'=> !$skill->active,
        ]);
        return back();
     }

     public function destroy(Skill $skill){
        try{
            $path = $skill->img;
            $skill->delete();
            Storage::delete($path);
            $msg = "The Skill was deleted successfully";
        }catch(Exception $e){
            $msg = "Can't delete this skill";
        }

        session()->flash('msg',$msg);
        return back();
    }


    public function formArray($model){
        $lang=App::getLocale();
        $array=[];
        foreach($model as $value){
            $array[$value->id] = $value->nameLang($lang);
        }

        return $array;
    }
}