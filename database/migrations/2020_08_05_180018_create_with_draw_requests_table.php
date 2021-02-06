<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWithDrawRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('with_draw_requests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid')->unique()->nullable();
            $table->unsignedBigInteger('app_id')->nullable();
            $table->foreign('app_id')->references('id')->on('apps')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('earning_id')->nullable();
            $table->foreign('earning_id')->references('id')->on('earnings')->onDelete('cascade')->onUpdate('cascade');
            $table->dateTime('date')->nullable();
            $table->tinyInteger('status')->default('0')->comment = '0 = Pending ,1 = Approve, 2=Reject';
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
        Schema::dropIfExists('with_draw_requests');
    }
}
