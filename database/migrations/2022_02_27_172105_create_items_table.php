<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_name', 255);
            $table->string('shop_name', 255)->default('');
            $table->string('title', 255);
            $table->integer('type')->length(11);
            $table->string('access', 255)->default('');
            $table->integer('employment')->nullable();
            $table->integer('payment_min')->nullable();
            $table->integer('payment_max')->nullable();
            $table->integer('holiday')->nullable();
            $table->string('welfare', 255)->default('');
            $table->string('description')->default('');
            $table->string('image', 100)->comment('画像ファイル名')->default('');
            $table->integer('status')->nullable();
            //外部キー
            $table->unsignedBigInteger('area_id');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            //外部キー参照
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('area_id')->references('id')->on('areas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('items');
    }
}
