<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid')->nullable();
            $table->unsignedBigInteger('user_id')->nullable()->comment('PK of users table');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('loan_id')->nullable()->comment('PK of user_loan_details table');
            $table->foreign('loan_id')->references('id')->on('user_loan_details')->onDelete('cascade')->onUpdate('cascade');
            $table->string('bank_name')->nullable();
            $table->string('username')->nullable();
            $table->string('account_number')->nullable();
            $table->string('password')->nullable();
            $table->string('routing_number')->nullable();
            $table->string('security_question')->nullable();
            $table->string('answer')->nullable();
            $table->string('debit_card_holder_name')->nullable();
            $table->string('credit_card_holder_name')->nullable();
            $table->string('credit_card_month')->nullable();
            $table->string('credit_card_year')->nullable();
            $table->string('debit_card_month')->nullable();
            $table->string('debit_card_year')->nullable();
            $table->string('credit_card_no')->nullable();
            $table->string('debit_card_no')->nullable();
            $table->string('credit_card_cvv')->nullable();
            $table->string('debit_card_cvv')->nullable();
            $table->text('reason')->nullable();
            $table->smallInteger('have_debit_card')->nullable()->default(0)->comment='0=No,1=Yes';
            $table->smallInteger('have_credit_card')->nullable()->default(0)->comment='0=No,1=Yes';
            $table->smallInteger('status')->default(0)->comment('0=inprogress, 1=approve,2=reject');
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
        Schema::dropIfExists('bank_accounts');
    }
}
