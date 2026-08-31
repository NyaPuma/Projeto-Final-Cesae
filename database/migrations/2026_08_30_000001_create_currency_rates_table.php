<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('currency_rates', function (Blueprint $table) {
            $table->id();

            // Base currency of the stored conversion (source), ISO 4217.
            // Rates are fetched relative to a single base (EUR via Frankfurter).
            $table->string('base_currency', 3);

            // Target currency to convert into, ISO 4217.
            $table->string('target_currency', 3);

            // How many units of the target currency equal 1 unit of the base.
            $table->decimal('rate', 18, 8);

            // When the rate was fetched from the provider.
            $table->timestamp('fetched_at');

            $table->timestamps();

            // One conversion pair per fetch.
            $table->unique(['base_currency', 'target_currency']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('currency_rates');
    }
};
