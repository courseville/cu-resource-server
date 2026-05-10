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
        $modelsPath = app_path('Models/Resources');
        if (! file_exists($modelsPath)) {
            return;
        }

        $files = scandir($modelsPath);
        foreach ($files as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }

            $className = 'App\\Models\\Resources\\'.str_replace('.php', '', $file);
            if (class_exists($className)) {
                $model = new $className;
                $table = $model->getTable();

                if (Schema::hasTable($table) && ! Schema::hasColumn($table, 'sync_meta')) {
                    Schema::table($table, function (Blueprint $table) {
                        $table->jsonb('sync_meta')->nullable();
                    });
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $modelsPath = app_path('Models/Resources');
        if (! file_exists($modelsPath)) {
            return;
        }

        $files = scandir($modelsPath);
        foreach ($files as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }

            $className = 'App\\Models\\Resources\\'.str_replace('.php', '', $file);
            if (class_exists($className)) {
                $model = new $className;
                $table = $model->getTable();

                if (Schema::hasTable($table) && Schema::hasColumn($table, 'sync_meta')) {
                    Schema::table($table, function (Blueprint $table) {
                        $table->dropColumn('sync_meta');
                    });
                }
            }
        }
    }
};
