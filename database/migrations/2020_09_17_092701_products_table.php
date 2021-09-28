<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('code')->nullable();
            $table->text('name')->nullable();
            $table->text('name_en')->nullable();
            $table->text('slug')->nullable();
            $table->text('content')->nullable();
            $table->text('content_en')->nullable();
            $table->integer('price')->nullable();
            $table->text('image')->nullable();
            $table->text('more_image')->nullable();
            $table->text('origin')->nullable();
            $table->integer('status_product')->nullable()->comment('0: hết hàng, 1: còn hàng')->default('1');
            $table->integer('hot')->nullable();
            $table->integer('status')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->text('meta_keyword')->nullable();
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
