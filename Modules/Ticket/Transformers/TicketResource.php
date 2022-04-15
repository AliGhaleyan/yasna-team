<?php

namespace Modules\Ticket\Transformers;

use Illuminate\Http\Resources\Json\JsonResource;
use Modules\User\Transformers\UserResource;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "id"          => $this->id,
            "title"       => $this->title,
            "description" => $this->description,
            "status"      => $this->status,
            "code"        => $this->code,
            "closed"      => $this->closed,
            "user"        => UserResource::make($this->user),
            "comments"    => CommentResource::collection($this->comments),
        ];
    }
}
