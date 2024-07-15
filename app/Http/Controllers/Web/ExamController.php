<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends WebController
{
    public function show($id){
        $data['exam'] = Exam::findOrFail($id);
        $user = Auth::user();
        $data['canViewStartBtn'] = true;

        if($user != null){
            $pivotRow = $user->exams()->where('exam_id',$id)->first();
            if($pivotRow != null and $pivotRow->pivot->status == 'closed'){
                $data['canViewStartBtn'] = false;
            }
        }
        return view('web.exams.show')->with($data);
    }

    public function start($examId){
        $user = Auth::user();

        if(! $user->exams->contains($examId)){
            $user->exams()->attach($examId);
        }else{
            $user->exams()->updateExistingPivot($examId, [
                'status'=>'closed',
            ]);
        }

        session()->flash('prev' , "start/$examId");
        return redirect(url("exams/questions/$examId"));
    }

    public function questions($examId, Request $request){
        if(session('prev') != "start/$examId"){
            return redirect(url("exams/show/$examId"));
        }
        $data['exam'] = Exam::findOrFail($examId);
        $request->session()->flash('prev' , "questions/$examId");

        return view('web.exams.questions')->with($data);
    }


    public function submit($examId,Request $request){
        if(session('prev') != "questions/$examId"){
            return redirect(url("exams/show/$examId"));
        }

        $request->validate([
            'answers'=> 'required|array',
            'answers.*'=> 'required|in:1,2,3,4'
        ]);

        // calculating exam score
        $points = 0;
        $exam = Exam::findOrFail($examId);
        foreach($exam->questions as $question){
            if(isset($request->answers[$question->id])){
                $userAnswer = $request->answers[$question->id];
                $rightAnswer = $question->right_ans;
                if((int)$userAnswer === $rightAnswer){
                    $points++;
                }
            }
        }

        $totalQuestoinsNumber = $exam->questions_no;
        $score = ($points / $totalQuestoinsNumber)*100;

        //Calculating Time Mins
        $user = Auth::user();
        $pivotRow = $user->exams()->where('exam_id',$examId)->first();
        $startTime = $pivotRow->pivot->created_at;
        $submitTime = Carbon::now();

        $timeMins = $submitTime->diffInMinutes($startTime);

        if($timeMins > $pivotRow->duration_mins){
            $score = 0;
        }

        // update pivot row
        $user->exams()->updateExistingPivot($examId, [
            'score' => $score,
            'time_mins' => $timeMins
        ]);

        session()->flash("success", "you finished the exam successfully with score $score%");
        return redirect(url("exams/show/$examId"));
    }
}
