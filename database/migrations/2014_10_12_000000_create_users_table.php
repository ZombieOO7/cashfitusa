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
            $table->bigIncrements('id');
            $table->uuid('uuid')->unique()->nullable();
            // $table->string('first_name')->nullable();
            // $table->string('middle_name')->nullable();
            // $table->string('last_name')->nullable();
            $table->string('email')->nullable();
            // $table->string('phone1')->nullable();
            // $table->string('phone2')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            // $table->text('address1')->nullable();
            // $table->text('address2')->nullable();
            // $table->string('city')->nullable();
            // $table->string('state')->nullable();
            // $table->string('zip_code')->nullable();
            // $table->string('time_of_residency')->nullable();
            $table->tinyInteger('status')->default('1')->comment = '0 = Inactive ,1 = Active';
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
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