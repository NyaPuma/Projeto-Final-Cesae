<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('user_preferences', function (Blueprint $table) {
            // Formato de números: define os separadores decimal e de milhar
            // Formato: json com decimal_separator e thousand_separator
            // Ex: {"decimal": ",", "thousand": "."} para pt-PT
            // Ex: {"decimal": ".", "thousand": ","} para en-US
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
