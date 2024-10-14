<?php

namespace App\Models;

use App\Enums\TransactionStatus;
use App\Enums\TransactionType;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Wallet extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'balance',
    ];

    /**
     * @return Attribute
     */
    protected function balance(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => number_format($value, 2),
        );
    }

    /**
     * @param  int         $amount
     * @param  string      $description
     * @param  array       $meta
     * @param  [type]      $status
     *
     * @return Transaction
     */
    public function deposit(int $amount, string $description, array $meta = [], TransactionStatus $status = TransactionStatus::SUCCESSFUL): Transaction
    {
        return $this->transact(TransactionType::DEPOSIT, $amount, $description, $meta, $status);
    }

    /**
     * @param  int         $amount
     * @param  string      $description
     * @param  array       $meta
     * @param  [type]      $status
     *
     * @return Transaction
     */
    public function withdraw(int $amount, string $description, array $meta = [], TransactionStatus $status = TransactionStatus::SUCCESSFUL): Transaction
    {
        return $this->transact(TransactionType::WITHDRAWAL, $amount, $description, $meta, $status);
    }

    /**
     * @param  TransactionType   $type
     * @param  int               $amount
     * @param  string            $description
     * @param  array             $meta
     * @param  TransactionStatus $status
     *
     * @return Transaction
     */
    public function transact(TransactionType $type, int $amount, string $description, array $meta, TransactionStatus $status): Transaction
    {
        $transaction = $this->transactions()->create([
            'type' => $type,
            'amount' => $amount,
            'description' => $description,
            'meta' => $meta,
            'status' => $status,
        ]);

        if ($status == TransactionStatus::SUCCESSFUL) {

            if ($type === TransactionType::WITHDRAWAL) {
                $this->balance -= $amount;
            } else if ($type === TransactionType::DEPOSIT) {
                $this->balance += $amount;
            }

            $this->save();
        }

        return $transaction;
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return HasMany
     */
    public function transactions(): HasMany
    {
        return $this->hasMany(Transaction::class);
    }
}
