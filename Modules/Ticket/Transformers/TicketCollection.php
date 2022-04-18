<?php

namespace Modules\Ticket\Transformers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Modules\User\Transformers\UserResource;

class TicketCollection extends ResourceCollection
{
    public $collects = JsonResource::class;

    /**
     * Transform the resource collection into an array.
     *
     * @param Request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function ($item) use ($request) {
            return [
                "id"          => $item->id,
                "title"       => $item->title,
                "description" => $item->description,
                "status"      => $item->status,
                "code"        => $item->code,
                "closed"      => $item->closed,
                "user"        => UserResource::make($item->user),
            ];
        })->all();
    }
}
