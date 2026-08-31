<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * A stored currency exchange-rate conversion for a single
 * base→target pair, fetched twice per day by `currency:update-rates`.
 */
final class ExchangeRate extends Model
{
    protected $table = 'currency_rates';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'base_currency',
        'target_currency',
        'rate',
        'fetched_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'base_currency' => 'string',
        'target_currency' => 'string',
        'rate' => 'decimal:8',
        'fetched_at' => 'datetime',
    ];
}
