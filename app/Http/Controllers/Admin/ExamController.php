<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Exam;
use App\Models\Skill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ExamController extends AdminController
{
    public function index(){
        $data['exams'] = Exam::select('id','name','skill_id','img','questions_no','active')
        ->orderBy('id','desc')
        ->paginate(8);
        return view('admin.exams.index')->with($data);
    }

    public function show(Exam $exam){
        $data['exam'] = $exam;
        return view('admin.exams.show')->with($data);
    }

    public function showQuestions(Exam $exam){
        $data['exam'] = $exam;
        return view('admin.exams.questions')->with($data);
    }

    public function store(Request $request){
        $request->validate([
             'name_en'=>'required|string|max:50',
             'name_ar'=>'required|string|max:50',
             'img'=> 'required|image',
             'skill_id'=> 'required|exists:categories,id',
             'duration_mins'=>'required|',
             'questions_no'=>'',
             'difficulty'=>'',

        ]);

        $path = Storage::putFile("skills",$request->file('img'));

        Skill::create([
             'name'=>json_encode([
                 'en'=>$request->name_en,
                 'ar'=> $request->name_ar,
             ]),
             'img'=>$path,
             'category_id' => $request->category_id,
         ]);

         session()->flash('msg','Skill added successfully');
         return back();
     }


    public function toggle(Exam $exam){
        $exam->update([
            'active'=> !$exam->active,
        ]);
        return back();
     }

    public function destroy(Exam $exam){
        try{
            $path = $exam->img;
            $exam->delete();
            Storage::delete($path);
            $msg = "Exam deleted successfully";
        }catch(Exception $e){
            $msg = "Can't delete this exam";
        }

        session()->flash('msg',$msg);
        return back();
    }

}
