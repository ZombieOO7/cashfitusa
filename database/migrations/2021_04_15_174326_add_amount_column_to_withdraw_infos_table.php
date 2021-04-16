<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAmountColumnToWithdrawInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('withdraw_infos', function (Blueprint $table) {
            if (!Schema::hasColumn('withdraw_infos', 'amount')) {
                $table->double('amount')->default(0);
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
        Schema::table('withdraw_infos', function (Blueprint $table) {
            if (!Schema::hasColumn('withdraw_infos', 'amount')) {
                $table->dropColumn('amount');
            }
        });
    }
}
