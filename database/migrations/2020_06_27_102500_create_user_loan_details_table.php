<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserLoanDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_loan_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid')->unique()->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone1')->nullable();
            $table->string('phone2')->nullable();
            $table->text('address1')->nullable();
            $table->text('address2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('time_of_residency')->nullable();
            $table->string('bank_name')->nullable();
            $table->integer('account_type')->nullable();
            $table->string('account_number')->nullable();
            $table->text('bank_address')->nullable();
            $table->double('loan_amount')->nullable();
            $table->double('repayment_amount')->nullable();
            $table->double('months')->nullable();
            $table->tinyInteger('past_loan')->default('1')->comment = '0 = No ,1 = Yes';
            $table->tinyInteger('pending_loan')->default('1')->comment = '0 = No ,1 = Yes';
            $table->tinyInteger('pending_bill')->default('1')->comment = '0 = No ,1 = Yes';
            $table->tinyInteger('status')->default('0')->comment = '0 = Pending ,1 = Approve, 2 = reject';
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
        Schema::dropIfExists('user_loan_details');
    }
}
