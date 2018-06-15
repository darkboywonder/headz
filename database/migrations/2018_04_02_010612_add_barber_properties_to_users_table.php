<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBarberPropertiesToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone_number')->after('password');
            $table->string('city')->after('password');
            $table->string('state')->after('password');
            $table->string('image')->nullable()->after('password');
            $table->boolean('is_barber')->default(false)->after('password');
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
            $table->dropColumn('phone_number');
            $table->dropColumn('city');
            $table->dropColumn('state');
            $table->dropColumn('image');
            $table->dropColumn('is_barber');
        });
    }
}
