<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoanNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('loan_detail_id')->nullable();
            $table->foreign('loan_detail_id')->references('id')->on('user_loan_details')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('earning_id')->nullable();
            $table->foreign('earning_id')->references('id')->on('earnings')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('user_earning_id')->nullable();
            $table->foreign('user_earning_id')->references('id')->on('user_earnings')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('loan_document_id')->nullable();
            $table->foreign('loan_document_id')->references('id')->on('loan_documents')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('app_id')->nullable();
            $table->foreign('app_id')->references('id')->on('apps')->onDelete('cascade')->onUpdate('cascade');
            $table->text('content')->nullable();
            $table->tinyInteger('type')->default('0')->comment = '1 = loan , 2=Earning';
            $table->tinyInteger('is_read')->default('0')->comment = '1 = No , 1=Yes';
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
        Schema::dropIfExists('loan_notifications');
    }
}
