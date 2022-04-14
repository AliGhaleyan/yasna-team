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

    const STATUS_INSTANTANEOUS = "instantaneous";
    const STATUS_NORMAL = "normal";
    const STATUS_NONSIGNIFICANT = "nonsignificant";

    protected $fillable = [
        "id",
        "title",
        "description",
        "status",
        "code",
        "user_id"
    ];

    public static function getAllStatuses(): array
    {
        return [
            self::STATUS_INSTANTANEOUS,
            self::STATUS_NORMAL,
            self::STATUS_NONSIGNIFICANT
        ];
    }

    public static function generateCode(): int
    {
        do {
            $code = random_int(10000000, 99999999);
            $find = self::query()->where("code", $code)->first();
        } while ($find);

        return $code;
    }
}
