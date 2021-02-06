<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBackLicenceColumnToEarningsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('earnings', function (Blueprint $table) {
            if(!Schema::hasColumn('earnings', 'back_licence')) {
                $table->string('back_licence')->nullable();
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
        Schema::table('earnings', function (Blueprint $table) {
            if(Schema::hasColumn('earnings', 'back_licence')) {
                $table->dropColumn('back_licence');
            }
        });
    }
}
