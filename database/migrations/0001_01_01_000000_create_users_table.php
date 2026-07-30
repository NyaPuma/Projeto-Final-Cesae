<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Perfis de Utilizador
        |--------------------------------------------------------------------------
        */

        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();

            $table->string('name', 100)
                ->unique();

            $table->text('description')
                ->nullable();

            $table->boolean('active')
                ->default(true);

            $table->timestamps();
            $table->softDeletes();

            $table->index('active');
        });

        /*
        |--------------------------------------------------------------------------
        | Utilizadores
        |--------------------------------------------------------------------------
        */

        Schema::create('users', function (Blueprint $table) {
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Relações
            |--------------------------------------------------------------------------
            */

            $table->foreignId('profile_id')
                ->nullable()
                ->constrained('user_profiles')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Informação pessoal
            |--------------------------------------------------------------------------
            */

            $table->string('name', 150);

            $table->string('email', 255)
                ->unique();

            $table->string('avatar_path', 255)
                ->nullable();

            $table->string('avatar_disk', 50)
                ->default('public');

            /*
            |--------------------------------------------------------------------------
            | Estado
            |--------------------------------------------------------------------------
            */

            $table->boolean('active')
                ->default(true);

            /*
            |--------------------------------------------------------------------------
            | Autenticação
            |--------------------------------------------------------------------------
            */

            $table->string('password');

            /*
            |--------------------------------------------------------------------------
            | Token API personalizado
            |--------------------------------------------------------------------------
            */

            $table->string('api_token', 80)
                ->nullable()
                ->unique();

            $table->timestamp('token_created_at')
                ->nullable();

            $table->rememberToken();

            /*
            |--------------------------------------------------------------------------
            | Segurança
            |--------------------------------------------------------------------------
            */

            $table->timestamp('email_verified_at')
                ->nullable();

            $table->timestamp('password_changed_at')
                ->nullable();

            $table->timestamp('last_login_at')
                ->nullable();

            $table->string('last_login_ip', 45)
                ->nullable();

            $table->unsignedInteger('login_attempts')
                ->default(0);

            $table->timestamp('locked_until')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Timestamps
            |--------------------------------------------------------------------------
            */

            $table->timestamps();

            $table->softDeletes();

            /*
            |--------------------------------------------------------------------------
            | Índices
            |--------------------------------------------------------------------------
            */

            $table->index('active');

            $table->index([
                'profile_id',
                'active',
                'deleted_at',
            ]);

            $table->index('last_login_at');

            $table->index('token_created_at');

            $table->index('locked_until');
        });

        /*
        |--------------------------------------------------------------------------
        | Recuperação de Password
        |--------------------------------------------------------------------------
        */

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email', 255)
                ->primary();

            $table->string('token', 255);

            $table->timestamp('created_at')
                ->nullable()
                ->index();
        });

        /*
        |--------------------------------------------------------------------------
        | Sessões
        |--------------------------------------------------------------------------
        */

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')
                ->primary();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->string('ip_address', 45)
                ->nullable();

            $table->text('user_agent')
                ->nullable();

            $table->longText('payload');

            $table->unsignedInteger('last_activity')
                ->index();

            /*
            |--------------------------------------------------------------------------
            | Índices
            |--------------------------------------------------------------------------
            */

            $table->index([
                'user_id',
                'last_activity',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('users');
        Schema::dropIfExists('user_profiles');
    }
};
