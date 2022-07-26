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
        Schema::create('receivables', function (Blueprint $table) {
            $table->id();
            $table->integer('supplier_id');
            $table->json('product_id')->nullable();
            $table->json('quantity')->nullable();
            $table->json('amount')->nullable();
            $table->string('invoice_no', 50)->nullable();
            $table->decimal('total_amount', 10, 2);
            $table->date('received_date')->nullable();
            $table->unsignedInteger('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('receivables');
    }
};
