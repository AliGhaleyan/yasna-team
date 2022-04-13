<?php

namespace Modules\Ticket\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Ticket
 * @package Modules\Ticket\Entities
 *
 * @property $id
 * @property $title
 * @property $description
 * @property $status
 * @property $code
 */
class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        "id",
        "title",
        "description",
        "status",
        "code",
    ];
}
