<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_category_id');
            $table->foreignId('product_label_id')->nullable();
            $table->string('name');
            $table->string('slug');
            $table->unsignedDouble('price');
            $table->string('description')->nullable();
            $table->text('option')->nullable();
            $table->string('half_image')->nullable();
            $table->string('full_image')->nullable();
            $table->boolean('is_featured')->default(0)->nullable();
            $table->boolean('is_published')->default(1)->nullable();
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
