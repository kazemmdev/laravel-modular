<?php

declare(strict_types=1);

namespace Modules\Users;

use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

/**
 * User model
 *
 * @property int                  id
 * @property string               name
 * @property string               email
 * @property string               phone
 * @property null|CarbonInterface created_at
 * @property null|CarbonInterface updated_at
 */
class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password'          => 'hashed',
    ];

    public static function newFactory(): UserFactory
    {
        return UserFactory::new();
    }
}
