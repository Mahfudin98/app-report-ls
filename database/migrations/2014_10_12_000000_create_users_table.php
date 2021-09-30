<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
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
            $table->string('image')->nullable();
            $table->unsignedBigInteger('position_id')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable(); //untuk position cs
            $table->string('name');
            $table->string('slug');
            // address
            $table->string('address');
            $table->string('phone');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            // user auth
            $table->string('username')->unique();
            $table->string('password');
            // status
            $table->enum('gender', ['Laki-laki', 'Perempuan']);
            $table->boolean('status')->default(true);
            $table->char('role', 1)->comment('0: admin, 1: user');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
