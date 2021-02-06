<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLoanDocumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('uuid')->unique()->nullable();
            $table->string('name')->nullable();
            $table->unsignedBigInteger('loan_id')->nullable();
            $table->foreign('loan_id')->references('id')->on('user_loan_details')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('earning_id')->nullable();
            $table->foreign('earning_id')->references('id')->on('earnings')->onDelete('cascade')->onUpdate('cascade');
            $table->tinyInteger('type')->default('0')->comment = '1 = Front Licence, 2 = Back Licence, 3= Address proof, 4=selfie';
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
        Schema::dropIfExists('loan_documents');
    }
}
