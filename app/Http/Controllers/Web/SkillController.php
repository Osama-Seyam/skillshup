<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Skill;
use Illuminate\Http\Request;

class SkillController extends WebController
{
    public function show($id){
        $data['skill'] = Skill::findOrFail($id);
        // $data['exams'] = $data['skill']->exams()->paginate(6);

        return view('web.skills.show')->with($data);
    }
}
