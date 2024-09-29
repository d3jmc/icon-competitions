<?php

namespace App\Models;

use App\Enums\Honorific;
use App\Enums\UserRole;
use App\Traits\HasAddress;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Billable, HasAddress, HasFactory, Notifiable, SoftDeletes;

    /**
     * @var array
     */
    protected $fillable = [
        'prefix',
        'first_name',
        'middle_name',
        'last_name',
        'email',
        'mobile_number',
        'password',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @return array
     */
    protected function casts(): array
    {
        return [
            'prefix' => Honorific::class,
            'role' => UserRole::class,
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * @return void
     */
    protected static function booted(): void
    {
        static::updated(function (self $model) {
            if ($model->hasVerifiedEmail() && !$model->stripe_id) {
                $model->createOrGetStripeCustomer();
            }
        });
    }
}
