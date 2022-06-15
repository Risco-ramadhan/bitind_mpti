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
        Schema::create('order_section', function (Blueprint $table) {
            $table->id();
            $table->integer('id_product');
            $table->string('domain', 20);
            $table->string('colour', 15);
            $table->string('url_reference', 20);
            $table->binary('image_reference');
            $table->string('bussiness_category', 30);
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
