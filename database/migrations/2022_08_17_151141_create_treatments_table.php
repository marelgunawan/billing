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
        Schema::create('treatments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('name_as');
            $table->integer('price_c1');
            $table->integer('price_c2');
            $table->integer('price_c3');
            $table->boolean('is_paten');
            $table->boolean('wajib');
            $table->integer('type'); // Update this!!
            $table->enum('type_bill', [1, 2]);
            $table->foreignId('poli_id')->constrained();
            $table->integer('order');
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
        Schema::dropIfExists('treatments');
    }
};
