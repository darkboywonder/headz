<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHoursColumnToBarbershopTable extends Migration
{
    public function up()
    {
        Schema::table('barbershops', function (Blueprint $table) {
            $table->string('hours')->after('phone')->nullable();
        });
    }

    public function down()
    {
        Schema::table('barbershops', function (Blueprint $table) {
            $table->dropColumn('hours');
        });
    }
}
