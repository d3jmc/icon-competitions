<?php

namespace App\Promotions;

use App\Models\Promotion;
use App\Models\PromotionAction;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class ApplyCredit
{
    /**
     * @param  Promotion       $promotion
     * @param  PromotionAction $action
     * @param  User            $user
     *
     * @return void
     */
    public function handle(Promotion $promotion, PromotionAction $action, User $user): void
    {
        Log::info('Applying credit to user ' . $user->id . ' from promotion ' . $promotion->id);

        $user->debitBalance((int) ($action->value * 100), $promotion->description ?? 'Balance debited by promotion (' . $promotion->id . ')');
    }
}