<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLoanTypeColumnToUserLoanDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_loan_details', function (Blueprint $table) {
            if(!Schema::hasColumn('user_loan_details', 'loan_type')) {
                $table->smallInteger('loan_type')->nullable()->default(1)->comment= '1 =Personal Loan, 2 = Payday Loan,3 =Medical Loan, 4 = Business Loan';
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
        Schema::table('user_loan_details', function (Blueprint $table) {
            $table->dropColumn('loan_type');
        });
    }
}
