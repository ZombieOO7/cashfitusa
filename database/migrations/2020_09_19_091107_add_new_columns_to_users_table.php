<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColumnsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if(!Schema::hasColumn('users', 'first_name')) {
                $table->string('first_name')->nullable();
            }
            if(!Schema::hasColumn('users', 'middle_name')) {
                $table->string('middle_name')->nullable();
            }
            if(!Schema::hasColumn('users', 'last_name')) {
                $table->string('last_name')->nullable();
            }
            if(!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->nullable();
            }
            if(!Schema::hasColumn('users', 'address')) {
                $table->text('address')->nullable();
            }
            if(!Schema::hasColumn('users', 'image')) {
                $table->string('image')->nullable();
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
        Schema::table('users', function (Blueprint $table) {
            if(Schema::hasColumn('users', 'first_name')) {
                $table->dropColumn('first_name');
            }
            if(Schema::hasColumn('users', 'middle_name')) {
                $table->dropColumn('middle_name');
            }
            if(Schema::hasColumn('users', 'last_name')) {
                $table->dropColumn('last_name');
            }
            if(Schema::hasColumn('users', 'phone')) {
                $table->dropColumn('phone');
            }
            if(Schema::hasColumn('users', 'address')) {
                $table->dropColumn('address');
            }
            if(Schema::hasColumn('users', 'image')) {
                $table->dropColumn('image');
            }
        });
    }
}
