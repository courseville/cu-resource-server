<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateTransformerMappingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('transformer_mappings', function (Blueprint $table) {
            $table->dropColumn('source');

            $table->foreignId('data_source_id')
                ->constrained('data_sources')
                ->onDelete('cascade')
                ->after('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('transformer_mappings', function (Blueprint $table) {
            $table->string('source');

            $table->dropForeign(['data_source_id']);
            $table->dropColumn('data_source_id');
        });
    }
}
