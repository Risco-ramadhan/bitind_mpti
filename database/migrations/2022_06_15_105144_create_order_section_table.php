<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderSectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_sections', function (Blueprint $table) {
            $table->id();
            $table->integer('userid')->nullable();
            $table->integer('id_product');
            $table->string('domain', 20);
            $table->string('color1', 15);
            $table->string('color2', 15);
            $table->string('color3', 15);
            $table->string('url_reference', 150);
            $table->integer('image_reference')->nullable();
            $table->string('bussiness_name', 80);
            $table->text('description_detail');
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
        Schema::dropIfExists('order_section');
    }
}
