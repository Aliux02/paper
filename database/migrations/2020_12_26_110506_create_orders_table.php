<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('uzsakovas');
            $table->string('pavadinimas');
            $table->integer('ilgis');
            $table->integer('plotis');
            $table->string('medziaga');
            $table->string('klijai');
            $table->integer('eiles');
            $table->integer('spalva');
            $table->integer('kiekis');
            $table->integer('status')->nullable();
            $table->foreignId('machine_id')->nullable()->references('id')->on('machines');
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
        Schema::dropIfExists('orders');
    }
}
