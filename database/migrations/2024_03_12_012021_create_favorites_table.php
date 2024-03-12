<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('user_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('favorites');
        Schema::table('favorites', function (Blueprint $table) {
            // 追加 (外部キー名は{テーブル名}_{カラム名}_foreign)
            $table->dropForeign('favorites_post_id_foreign');
            $table->dropForeign('favorites_user_id_foreign');
            $table->dropColumn('post_id');
            $table->dropColumn('user_id');
        });
    }
};
