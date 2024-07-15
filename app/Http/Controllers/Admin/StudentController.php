<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StudentController extends Controller
{
    public function index(){
        $studentRole = Role::where('name','student')->first();
        $data['students'] = User::where('role_id',$studentRole->id)
        ->orderBy('id','desc')
        ->paginate(10);

        return view('admin.students.index')->with($data);
    }

    public function show($id){
        $student = User::findOrFail($id);
        if($student->role->name !== 'student'){
            return back();
        }

        $data['student'] = $student;
        $data['exams'] = $student->exams;
        return view('admin.students.show')->with($data);
    }

    public function open($studentId,$examId){
        $student = User::findOrFail($studentId);
        $student->exams()->updateExistingPivot($examId, [
            'status' => 'opened'
        ]);
        return back();
    }
    public function close($studentId,$examId){
        $student = User::findOrFail($studentId);
        $student->exams()->updateExistingPivot($examId, [
            'status' => 'closed'
        ]);
        return back();
    }
}
