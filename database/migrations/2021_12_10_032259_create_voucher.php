<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoucher extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voucher', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name'); //tên
            $table->string('code'); //mã
            $table->integer('number'); // số giảm
            $table->integer('type'); //1 giam theo %, 2 giảm theo số tiền / tổng hóa đơn
            $table->integer('total')->default(0); // còn lại
            $table->integer('used')->default(0); // Đã dùng
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('voucher');
    }
}
