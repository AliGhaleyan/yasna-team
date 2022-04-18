<?php


namespace Modules\User\Entities;


use Illuminate\Database\Eloquent\Model;

/**
 * Class ACLEntity
 * @package Modules\User\Entities
 *
 * @property $id
 * @property $name
 */
abstract class ACLEntity extends Model
{
    protected $fillable = ["name"];

    public static function findByName(string $name): self
    {
        return static::query()->where("name", $name)->first();
    }
}
