<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Exam;
use App\Models\Skill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ExamController extends Controller
{
    public function index(){
        $data['exams'] = Exam::paginate(8);
        $data['skills'] = Skill::select('id','name')->get();
        return view('admin.exams.index')->with($data);
    }

    public function toggle(Exam $exam){
        $exam->update([
            'active'=> !$exam->active,
        ]);
        return back();
     }

    public function delete(Exam $exam){
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
