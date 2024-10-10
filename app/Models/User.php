<?php

namespace App\Models;

use App\Enums\Honorific;
use App\Enums\UserRole;
use App\Traits\HasAddress;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
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
        'last_login_at',
        'last_login_ip',
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

    /**
     * @return Attribute
     */
    protected function fullName(): Attribute
    {
        return new Attribute(function ($value) {
            return "{$this->prefix->value} {$this->first_name} {$this->last_name}";
        });
    }

    /**
     * @return HasMany
     */
    public function tickets(): HasMany
    {
        return $this->hasMany(Ticket::class);
    }

    /**
     * @return Ticket|null
     */
    public function latestTicket(): ?Ticket
    {
        return $this->tickets()->latest()->first();
    }

    /**
     * @return HasMany
     */
    public function instantWins(): HasMany
    {
        return $this->tickets()->instantWin($this->id);
    }

    /**
     * @return Ticket|null
     */
    public function latestInstantWin(): ?Ticket
    {
        return $this->instantWins()->latest()->first();
    }

    /**
     * @return HasManyThrough
     */
    public function competitions(): HasManyThrough
    {
        return $this->hasManyThrough(Competition::class, Ticket::class, 'id', 'id');
    }

    /**
     * @return Competition|null
     */
    public function latestCompetition(): ?Competition
    {
        return $this->competitions()->latest()->first();
    }
}
