<?php

namespace Modules\Ticket\Entities;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Comment
 * @package Modules\Comment\Entities
 *
 * @property $text
 */
class Comment extends Model
{
    protected $fillable = ["text"];
}
