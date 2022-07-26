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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('code')->nullable();
            $table->string('brand', 100)->nullable();
            $table->integer('stock_in')->default(0);
            $table->integer('stock_out')->default(0);
            $table->decimal('cost', 10,2)->default(0)->comment('cost price');
            $table->decimal('price', 10,2)->default(0)->comment('selling price');
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
};
