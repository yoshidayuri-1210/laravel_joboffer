<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('profile')->default('');
            $table->date('birthdate')->nullable();
            $table->string('sex')->default('');
            //外部キー(カテゴリ)
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('area_id')->nullable();
            
            //外部キーの設定（参照）
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropForeign(['area_id']);
            $table->dropColumn('profile');
            $table->dropColumn('birthdate');
            $table->dropColumn('sex');
            $table->dropColumn('category_id');
            $table->dropColumn('area_id');
        });
    }
}
