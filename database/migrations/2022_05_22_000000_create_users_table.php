<?php

use App\Models\User;
use Illuminate\Support\Facades\Hash;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username')->unique();
            $table->unsignedTinyInteger('role')->default(0);
            $table->string('contact', 15)->nullable();
            $table->string('position')->nullable();
            $table->string('password');
            $table->timestamps();
            $table->softDeletes();
        });

        User::create([
            'name' => 'Samuel Sarpong-Duah',
            'username' => 'sam119',
            'role' => 1,
            'contact' => '1234567890',
            'position' => 'Super Admin',
            'password' => Hash::make('sammie119'),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
