<?php

namespace App\Models;

use App\Enums\PromotionStatus;
use App\Enums\PromotionType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Promotion extends Model
{
    use HasFactory;

    /**
     * @param  Builder $query
     *
     * @return void
     */
    public function scopeInactive(Builder $query): void
    {
        $query->where('status', PromotionStatus::INACTIVE);
    }

    /**
     * @param  Builder $query
     *
     * @return void
     */
    public function scopeActive(Builder $query): void
    {
        $query->where('status', PromotionStatus::ACTIVE);
    }

    /**
     * @param  Builder $query
     *
     * @return void
     */
    public function scopeSignUps(Builder $query): void
    {
        $query->where('type', PromotionType::SIGN_UP);
    }

    /**
     * @param  User $user
     *
     * @return void
     */
    public function trigger(User $user): void
    {
        // @todo - create a log so we know what promotions a user has had applied
        $this->actions->each(function (PromotionAction $action) use ($user) {
            (new $action->namespace)->handle($this, $action, $user);
        });
    }

    /**
     * @return HasMany
     */
    public function actions(): HasMany
    {
        return $this->hasMany(PromotionAction::class);
    }
}
