<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserEarningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_earnings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid')->unique()->nullable();
            $table->unsignedBigInteger('app_id')->nullable();
            $table->foreign('app_id')->references('id')->on('apps')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('earning_user_id')->nullable();
            $table->foreign('earning_user_id')->references('id')->on('earnings')->onDelete('cascade')->onUpdate('cascade');
            $table->string('account_no')->nullable();
            $table->double('amount')->nullable()->default(0);
            $table->timestamp('date')->nullable();
            $table->tinyInteger('status')->default('0')->comment = '0 = Credit ,1 = Withdraw';
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
        Schema::dropIfExists('user_earnings');
    }
}
