<?php

namespace Modules\Ticket\Http\Controllers;

use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Ticket\Entities\Comment;
use Modules\Ticket\Entities\Ticket;
use Modules\Ticket\Http\Requests\StoreCommentRequest;

class CommentController extends Controller
{
    /**
     * Create new comment for selected ticket
     *
     * @param Ticket $ticket
     * @param StoreCommentRequest $request
     * @return ResponseFactory|Response
     */
    public function store(Ticket $ticket, StoreCommentRequest $request)
    {
        return response(Comment::query()->create(array_merge([
            "user_id" => Auth::id(),
            "ticket_id" => $ticket->id
        ], $request->validated())));
    }
}
