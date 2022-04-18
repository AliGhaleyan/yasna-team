<?php

namespace Modules\Ticket\Entities;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
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

    /**
     * Get statuses list
     *
     * @return array
     */
    public static function getAllStatuses(): array
    {
        return [
            self::STATUS_INSTANTANEOUS,
            self::STATUS_NORMAL,
            self::STATUS_NONSIGNIFICANT
        ];
    }

    /**
     * Generate random and unique code
     *
     * @param TicketRepository $repository
     * @return int
     * @throws Exception
     */
    public static function generateCode(TicketRepository $repository): int
    {
        do {
            $code = random_int(10000000, 99999999);
            $find = $repository->find($code);
        } while ($find);

        return $code;
    }

    /**
     * Create a new factory instance for the model.
     *
     * @return TicketFactory
     */
    protected static function newFactory(): TicketFactory
    {
        return new TicketFactory;
    }

    /**
     * Get owner user
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get answer comments
     *
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
}
