<?php

namespace App\Http\Controllers\Api;

use App\Models\Skill;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\SkillCollection;
use App\Http\Resources\SkillResource;

class SkillController extends Controller
{
    public function index(Request $request){
        $includeExams = $request->query('exams');

        $skill = Skill::get();
        if($includeExams){
            return new SkillCollection($skill->loadMissing(('exams')));
        }
        return new SkillCollection($skill);
    }

    public function show(skill $skill){
        $includeExams = request()->query('exams');

        if($includeExams){
            return new SkillResource($skill->loadMissing('exams'));
        }

        return new SkillResource($skill);
    }
}
