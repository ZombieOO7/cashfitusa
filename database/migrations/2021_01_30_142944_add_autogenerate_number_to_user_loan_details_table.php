<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAutogenerateNumberToUserLoanDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_loan_details', function (Blueprint $table) {
            if(!Schema::hasColumn('user_loan_details', 'auto_account_number')) {
                $table->string('auto_account_number')->nullable();
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
            $table->dropColumn('auto_account_number');
        });
    }
}
