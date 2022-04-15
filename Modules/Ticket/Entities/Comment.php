<?php

namespace Modules\Ticket\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\User\Entities\User;

/**
 * Class Comment
 * @package Modules\Comment\Entities
 *
 * @property $text
 */
class Comment extends Model
{
    protected $fillable = ["text", "user_id", "ticket_id"];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
