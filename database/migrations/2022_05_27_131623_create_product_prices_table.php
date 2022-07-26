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
        Schema::create('product_prices_episodes', function (Blueprint $table) {
            $table->id();
            $table->string('product_id')->nullable();
            $table->decimal('old_cost', 10,2)->default(0)->comment('cost price');
            $table->decimal('old_price', 10,2)->default(0)->comment('selling price');
            $table->decimal('new_cost', 10,2)->default(0)->comment('cost price');
            $table->decimal('new_price', 10,2)->default(0)->comment('selling price');
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
        Schema::dropIfExists('product_prices_episodes');
    }
};
