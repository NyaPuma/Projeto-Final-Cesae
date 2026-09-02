<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_preferences', function (Blueprint $table) {
            // Number format JSON can include the "example" field (e.g. {"decimal":".","thousand":",","example":"1,234.56"}),
            // which exceeds the previous VARCHAR(50) length and caused MySQL error 1406 on insert.
            $table->string('number_format', 191)
                ->nullable()
                ->default('{"decimal":".","thousand":","}')
                ->change();
        });
    }

    public function down(): void
    {
        Schema::table('user_preferences', function (Blueprint $table) {
            $table->string('number_format', 50)
                ->nullable()
                ->default('{"decimal":".","thousand":","}')
                ->change();
        });
    }
};
