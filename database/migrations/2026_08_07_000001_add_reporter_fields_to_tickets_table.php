<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->foreignId('user_id')
                ->nullable()
                ->change();

            $table->string('reporter_name', 150)
                ->nullable()
                ->after('user_id');

            $table->string('reporter_contact', 150)
                ->nullable()
                ->after('reporter_name');

            $table->string('source', 20)
                ->default('web')
                ->after('reporter_contact');
        });

        Schema::table('ticket_attachments', function (Blueprint $table) {
            $table->foreignId('user_id')
                ->nullable()
                ->change();
        });
    }

    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn(['reporter_name', 'reporter_contact', 'source']);
        });
    }
};
