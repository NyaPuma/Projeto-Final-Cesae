<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_preferences', function (Blueprint $table) {
            // Number format: defines decimal and thousand separators
            // Format: json with decimal_separator and thousand_separator
            // Example: {"decimal": ",", "thousand": "."} for pt-PT
            // Example: {"decimal": ".", "thousand": ","} for en-US
            $table->string('number_format', 50)
                ->nullable()
                ->default('{"decimal":".","thousand":","}')
                ->after('date_format');
        });
    }

    public function down(): void
    {
        Schema::table('user_preferences', function (Blueprint $table) {
            $table->dropColumn('number_format');
        });
    }
};
