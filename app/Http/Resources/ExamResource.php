<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExamResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nameEnglish' => $this->name('en'),
            'nameArabic' => $this->name('ar'),
            'descreptionEnglish' => $this->desc('en'),
            'descreptionArabic' => $this->desc('ar'),
            'image' => asset("uploads/$this->img"),
            'questionNumber' => $this->questions_no,
            'durationMins' => $this->duration_mins,
            'difficulty' => $this->difficulty,
            'questions' => QuestionResource::collection($this->whenLoaded('questions')),
        ];
    }
}
