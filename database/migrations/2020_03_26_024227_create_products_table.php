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
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->string('image')->nullable();
            $table->string('gallery')->nullable();
            $table->text('description')->nullable();
            $table->longtext('content')->nullable();
            $table->integer('price')->nullable();
            $table->integer('price_guarantee')->nullable();
            $table->float('vat')->nullable();
            $table->boolean('isSale')->nullable();
            $table->boolean('hot')->nullable();
            $table->integer('amount')->nullable();

            $table->integer('cate_id')->unsigned()->nullable();
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
