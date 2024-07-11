<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class canEnterExam
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $examId = $request->route()->parameter('id');
        $user = Auth::user();

        $pivotRow = $user->exams()->where('exam_id',$examId)->first();
        if($pivotRow !== null and $pivotRow->pivot->status == 'closed'){
            return redirect(url('/'));
        }
        return $next($request);
    }
}
