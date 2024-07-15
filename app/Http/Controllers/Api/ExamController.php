<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Exam;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ExamResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ExamCollection;
use Illuminate\Support\Facades\Validator;

class ExamController extends Controller
{
    public function index(Request $request){
        $includeQuestions = $request->query('questions');

        $exam = Exam::get();
        if($includeQuestions){
            return new ExamCollection($exam->loadMissing(('questions')));
        }
        return new ExamCollection($exam);
    }

    public function show(Exam $exam){
        $includeQuestions = request()->query('questions');

        if($includeQuestions){
            return new ExamResource($exam->loadMissing('questions'));
        }

        return new ExamResource($exam);
    }

    public function start($examId, Request $request){
        $request->user()->exams()->attach($examId);

        return response()->json([
            'message'=> "you started exam {$examId}"
        ]);
    }

    public function submit($examId,Request $request){
        $validator = Validator::make($request->all() ,[
            'answers'=> 'required|array',
            'answers.*'=> 'required|in:1,2,3,4'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors());
        }
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
        $user = $request->user();
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

        return response()->json([
            'messaeg'=>'exam submitted successfully',
        ]);
    }
}
