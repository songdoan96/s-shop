<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DevvnXaphuongthitran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('devvn_xaphuongthitran', function (Blueprint $table) {
            $table->id('xaid');
            $table->string('xa_name');
            $table->string('type');
            $table->string('maqh');
        });
        /*
        
         `xaid` varchar(5) CHARACTER SET utf8 NOT NULL,
  `xa_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `type` varchar(30) CHARACTER SET utf8 NOT NULL,
  `maqh` varchar(5) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`xaid`)
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
