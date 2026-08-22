<?php

declare(strict_types=1);

use App\Models\UserPreference;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Popula as preferências para utilizadores existentes.
     * Define valores default: language=pt, currency=EUR, date_format=d/m/Y
     */
    public function up(): void
    {
        // Get all users who don't have preferences defined
        $usersWithoutPrefs = \DB::table('users')
            ->leftJoin('user_preferences', 'users.id', '=', 'user_preferences.user_id')
            ->whereNull('user_preferences.user_id')
            ->select('users.id')
            ->get();

        $now = now();

        foreach ($usersWithoutPrefs as $user) {
            UserPreference::create([
                'user_id' => $user->id,
                'language' => 'pt',
                'currency' => 'EUR',
                'date_format' => 'd/m/Y',
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }
    }

    /**
     * Removes the preferences created by this migration (reversible).
     */
    public function down(): void
    {
        // Remove only the preferences created with this migration's default values
        UserPreference::where('language', 'pt')
            ->where('currency', 'EUR')
            ->where('date_format', 'd/m/Y')
            ->delete();
    }
};
