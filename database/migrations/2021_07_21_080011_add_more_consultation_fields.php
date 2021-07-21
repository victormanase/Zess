<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreConsultationFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consultations', function (Blueprint $table) {
            $table->string('case_no', 100)->nullable()->after("status");
            $table->string('policy_no', 100)->nullable()->after("status");
            $table->string('c_o', 100)->nullable()->after("status");
            $table->text('hx_of_presenting_illness')->nullable()->after("status");
            $table->text('past_medical_hx')->nullable()->after("status");
            $table->text('any_known_allergies')->nullable()->after("status");
            $table->string('o_e', 100)->nullable()->after("status");
            $table->string('bp', 100)->nullable()->after("status");
            $table->string('rr', 100)->nullable()->after("status");
            $table->string('spo2', 100)->nullable()->after("status");
            $table->string('pr', 100)->nullable()->after("status");
            $table->string('temp', 100)->nullable()->after("status");
            $table->string('height', 100)->nullable()->after("status");
            $table->string('weight', 100)->nullable()->after("status");
            $table->string('fbs_rbg', 100)->nullable()->after("status");
            $table->string('rs', 100)->nullable()->after("status");
            $table->string('cvs', 100)->nullable()->after("status");
            $table->string('pa', 100)->nullable()->after("status");
            $table->string('cns', 100)->nullable()->after("status");
            $table->string('others', 100)->nullable()->after("status");
            $table->string('doctors_advice', 100)->nullable()->after("status");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consultations', function (Blueprint $table) {
            $table->dropColumn('case_no');
            $table->dropColumn('policy_no');
            $table->dropColumn('c_o');
            $table->dropColumn('hx_of_presenting_illness');
            $table->dropColumn('past_medical_hx');
            $table->dropColumn('any_known_allergies');
            $table->dropColumn('o_e');
            $table->dropColumn('bp');
            $table->dropColumn('rr');
            $table->dropColumn('spo2');
            $table->dropColumn('pr');
            $table->dropColumn('temp');
            $table->dropColumn('height');
            $table->dropColumn('weight');
            $table->dropColumn('fbs_rbg');
            $table->dropColumn('rs');
            $table->dropColumn('cvs');
            $table->dropColumn('pa');
            $table->dropColumn('cns');
            $table->dropColumn('others');
            $table->dropColumn('doctors_advice');
        });
    }
}
