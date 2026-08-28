<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Information
            |--------------------------------------------------------------------------
            */

            $table->string('name', 100);

            $table->string('code', 50)
                ->unique();

            $table->string('building', 100)
                ->nullable();

            $table->string('floor', 50)
                ->nullable();

            $table->string('location', 255)
                ->nullable();

            $table->unsignedSmallInteger('capacity')
                ->nullable();

            $table->text('description')
                ->nullable();

            $table->text('notes')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */

            $table->boolean('active')
                ->default(true);

            /*
            |--------------------------------------------------------------------------
            | Timestamps
            |--------------------------------------------------------------------------
            */

            $table->timestamps();

            $table->softDeletes();

            /*
            |--------------------------------------------------------------------------
            | Indexes
            |--------------------------------------------------------------------------
            */

            // Unique code lookup already has an index via UNIQUE

            // Rooms by building and floor
            $table->index([
                'building',
                'floor',
            ]);

            // Active rooms by building
            $table->index([
                'building',
                'active',
            ]);

            // General listing of available rooms
            $table->index([
                'active',
                'deleted_at',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
