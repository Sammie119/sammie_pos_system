<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_settings', function (Blueprint $table) {
            $table->id();
            $table->string('shop_name')->nullable();
            $table->string('address')->nullable();
            $table->string('phone1', 20)->nullable();
            $table->string('phone2', 20)->nullable();
            $table->string('text_logo')->nullable();
            $table->string('email')->nullable();
            $table->string('facebook')->nullable();
            $table->timestamps();
        });

        DB::table('shop_settings')->insert([
            'shop_name' => 'Sammav Point of Sale System',
            'address' => 'Sammav',
            'phone1' => '0000000000',
            'phone2' => '0000000000',
            'text_logo' => 'Sam IT Consult',
            'email' => 'sammav2018@gmail.com',
            'facebook' => 'sammav2018@gmail.com',
            'created_at' =>  now(),
            'updated_at' =>  now(),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shop_settings');
    }
};
