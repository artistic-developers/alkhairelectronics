<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function(Blueprint $table)
        {
            $table->increments('product_id');
            $table->string('product_code')->unique();
            $table->string('product_name');
            $table->string('product_slug');
            $table->integer('category_id');
            $table->integer('company_id');
            $table->string('color');
            $table->string('model');
            $table->string('cost_price');
            $table->string('retail_price');
            $table->string('nick');
            $table->text('description');
            $table->string('discount');
            $table->integer('quantity')->default(0);
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
        Schema::dropIfExists('products');
    }
}
