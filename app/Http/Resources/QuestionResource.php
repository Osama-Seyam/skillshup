<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
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
            'title' => $this->title,
            'option1' => $this->option_1,
            'option2' => $this->option_2,
            'option3' => $this->option_3,
            'option4' => $this->option_4,
            'rightAnswer' => $this->right_ans,
        ];
    }
}
