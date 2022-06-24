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
            $table->integer('userid');
            $table->integer('id_product');
            $table->string('domain', 20);
            $table->string('color', 15);
            $table->string('url_reference', 150);
            $table->string('image_reference');
            $table->string('bussiness_category', 80);
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
