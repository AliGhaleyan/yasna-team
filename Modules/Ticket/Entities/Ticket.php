<?php

namespace Modules\Ticket\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\Ticket\Database\factories\TicketFactory;
use Modules\Ticket\Repositories\TicketRepository;
use Modules\User\Entities\User;

/**
 * Class Ticket
 * @package Modules\Ticket\Entities
 *
 * @property $id
 * @property $title
 * @property $description
 * @property $status
 * @property $code
 * @property $closed
 */
class Ticket extends Model
{
    use HasFactory;

    const STATUS_INSTANTANEOUS = "instantaneous";
    const STATUS_NORMAL = "normal";
    const STATUS_NONSIGNIFICANT = "nonsignificant";

    protected $fillable = [
        "id",
        "title",
        "description",
        "status",
        "code",
        "user_id",
        "closed"
    ];

    public static function getAllStatuses(): array
    {
        return [
            self::STATUS_INSTANTANEOUS,
            self::STATUS_NORMAL,
            self::STATUS_NONSIGNIFICANT
        ];
    }

    public static function generateCode(TicketRepository $repository): int
    {
        do {
            $code = random_int(10000000, 99999999);
            $find = $repository->find($code);
        } while ($find);

        return $code;
    }

    protected static function newFactory(): TicketFactory
    {
        return new TicketFactory;
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
