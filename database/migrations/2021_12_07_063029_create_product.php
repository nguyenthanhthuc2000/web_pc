<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug');
            $table->integer('category_id')->nullable();
            $table->integer('remains')->default(0); //sl con lai
            $table->integer('sold')->default(0); //sl da ban
            $table->text('options')->nullable(); //json
            $table->text('desc')->nullable(); //mo ta
            $table->text('content')->nullable(); //noi dung
            $table->string('image1')->nullable(); //hình anh
            $table->string('image2')->nullable(); //hình anh
            $table->string('image3')->nullable(); //hình anh
            $table->string('image4')->nullable(); //hình anh
            $table->integer('price')->default(0); //gia
            $table->integer('status')->default(0);
            $table->integer('selling')->default(0);
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
        Schema::dropIfExists('product');
    }
}
