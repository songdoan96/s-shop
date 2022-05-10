<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->text("fee_matp");
            $table->text("fee_maqh");
            $table->text("fee_xaid");
            $table->text("price");
            // $table->foreign('fee_matp')->references('matp')->on('devvn_tinhthanhpho')->onDelete('cascade');
            // $table->foreign('fee_maqh')->references('maqh')->on('devvn_quanhuyen')->onDelete('cascade');
            // $table->foreign('fee_xaid')->references('xaid')->on('devvn_xaphuongthitran')->onDelete('cascade');
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
        Schema::dropIfExists('fees');
    }
}