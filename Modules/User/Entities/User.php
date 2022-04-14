<?php


namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Junges\ACL\Concerns\HasPermissions;
use Laravel\Passport\HasApiTokens;
use Modules\User\Database\factories\UserFactory;

/**
 * Class User
 * @package Modules\User\Entities
 *
 * @property $id
 * @property $name
 * @property $email
 * @property $password
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasPermissions;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password'
    ];

    protected static function newFactory()
    {
        return new UserFactory;
    }
}

