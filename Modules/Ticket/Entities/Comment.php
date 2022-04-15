<?php

namespace Modules\Ticket\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Modules\Ticket\Database\factories\CommentFactory;
use Modules\User\Entities\User;

/**
 * Class Comment
 * @package Modules\Comment\Entities
 *
 * @property $text
 */
class Comment extends Model
{
    use HasFactory;

    protected $fillable = ["text", "user_id", "ticket_id"];

    protected static function newFactory(): CommentFactory
    {
        return new CommentFactory;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
