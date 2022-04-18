<?php

namespace Modules\Ticket\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Modules\User\Transformers\UserResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "text" => $this->text,
            "user" => UserResource::make($this->user),
        ];
    }
}
