<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLoanIdColumnToProceedDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('proceed_data', function (Blueprint $table) {
            if (!Schema::hasColumn('proceed_data', 'loan_id')) {
                $table->unsignedBigInteger('loan_id')->nullable();
                $table->foreign('loan_id')->references('id')->on('user_loan_details')->onDelete('cascade')->onUpdate('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('proceed_data', function (Blueprint $table) {
            //
        });
    }
}
