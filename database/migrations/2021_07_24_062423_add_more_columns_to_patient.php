<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreColumnsToPatient extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->text('complaints')->nullable();
            $table->string('reference_no', 100)->nullable();
            $table->text('note')->nullable();
            $table->string('hotel_room', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patients', function (Blueprint $table) {
            $table->dropColumn('hotel_room');
            $table->dropColumn('complaints');
            $table->dropColumn('reference_no');
            $table->dropColumn('note');
        });
    }
}
