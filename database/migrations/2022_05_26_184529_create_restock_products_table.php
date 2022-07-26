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
        Schema::create('restock_products', function (Blueprint $table) {
            $table->id();
            $table->string('product_id')->nullable();
            $table->integer('old_quantity')->default(0);
            $table->integer('old_stock')->default(0);
            $table->integer('old_sold')->default(0);
            $table->integer('new_quantity')->default(0);
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
        Schema::dropIfExists('restock_products');
    }
};
