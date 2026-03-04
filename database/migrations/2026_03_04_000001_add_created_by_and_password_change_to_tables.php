<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $tables = [
            'users',
            'sermons_playlists',
            'sermons',
            'documents',
            'films',
            'galleries',
            'subjects',
            'lectures',
            'audits',
        ];

        foreach ($tables as $tableName) {
            if (! Schema::hasTable($tableName)) {
                continue;
            }

            Schema::table($tableName, function (Blueprint $table) use ($tableName): void {
                if (! Schema::hasColumn($tableName, 'created_by')) {
                    $table->foreignId('created_by')->nullable()->after('id')->constrained('users')->nullOnDelete();
                }

                if ($tableName === 'users' && ! Schema::hasColumn('users', 'must_change_password')) {
                    $table->boolean('must_change_password')->default(true)->after('password');
                }
            });
        }

        if (Schema::hasTable('setting')) {
            Schema::table('setting', function (Blueprint $table): void {
                if (! Schema::hasColumn('setting', 'created_by')) {
                    $table->foreignId('created_by')->nullable()->after('id')->constrained('users')->nullOnDelete();
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $tables = [
            'users',
            'sermons_playlists',
            'sermons',
            'documents',
            'films',
            'galleries',
            'subjects',
            'lectures',
            'audits',
            'setting',
        ];

        foreach ($tables as $tableName) {
            if (! Schema::hasTable($tableName)) {
                continue;
            }

            Schema::table($tableName, function (Blueprint $table) use ($tableName): void {
                if ($tableName === 'users' && Schema::hasColumn('users', 'must_change_password')) {
                    $table->dropColumn('must_change_password');
                }

                if (Schema::hasColumn($tableName, 'created_by')) {
                    $table->dropForeign(['created_by']);
                    $table->dropColumn('created_by');
                }
            });
        }
    }
};
