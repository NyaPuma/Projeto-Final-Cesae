<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $driver = DB::getDriverName();

        if ($driver === 'sqlite') {
            DB::unprepared('
                CREATE TRIGGER IF NOT EXISTS audits_prevent_update
                AFTER UPDATE ON audits
                BEGIN
                    SELECT RAISE(ABORT, "audits table is append-only: UPDATE is not allowed");
                END;
            ');

            DB::unprepared('
                CREATE TRIGGER IF NOT EXISTS audits_prevent_delete
                AFTER DELETE ON audits
                BEGIN
                    SELECT RAISE(ABORT, "audits table is append-only: DELETE is not allowed");
                END;
            ');
        } elseif ($driver === 'mysql') {
            DB::unprepared('
                CREATE TRIGGER audits_prevent_update
                BEFORE UPDATE ON audits
                FOR EACH ROW
                BEGIN
                    SIGNAL SQLSTATE "45000"
                    SET MESSAGE_TEXT = "audits table is append-only: UPDATE is not allowed";
                END;
            ');

            DB::unprepared('
                CREATE TRIGGER audits_prevent_delete
                BEFORE DELETE ON audits
                FOR EACH ROW
                BEGIN
                    SIGNAL SQLSTATE "45000"
                    SET MESSAGE_TEXT = "audits table is append-only: DELETE is not allowed";
                END;
            ');
        }
    }

    public function down(): void
    {
        $driver = DB::getDriverName();

        if ($driver === 'sqlite') {
            DB::unprepared('DROP TRIGGER IF EXISTS audits_prevent_update');
            DB::unprepared('DROP TRIGGER IF EXISTS audits_prevent_delete');
        } elseif ($driver === 'mysql') {
            DB::unprepared('DROP TRIGGER IF EXISTS audits_prevent_update');
            DB::unprepared('DROP TRIGGER IF EXISTS audits_prevent_delete');
        }
    }
};
