<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    public static $wrap = '';
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'ticket_id' => $this->id,
            'ticket_title' => $this->title,
            'ticket_question' => $this->question,
            'ticket_status' => $this->status,
            'created_at' => $this->created_at->format('Y-m-d h:m:s'),
        ];
    }
}
