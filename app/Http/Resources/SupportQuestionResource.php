<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SupportQuestionResource extends JsonResource
{
    public static $wrap = 'question';

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'question' => $this->question,
            'created_at' => $this->created_at->format('Y-m-d h-m-s'),
            'messages_list' => SupportAnswerResource::collection($this->answersList)
        ];
    }
}
