<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('full_names');
            $table->unsignedInteger('policy_number');
            $table->unsignedInteger('risk_id');
            $table->unsignedInteger('underwriter_id');
            $table->foreign('underwriter_id')->references('id')->on('underwriter');
            $table->float("sum_insured", 8, 2);
            $table->float("political_risk", 8, 2);
            $table->float("excess_protector", 8, 2);
            $table->float("basic_premium", 8, 2);
            $table->date('annual_expiry_date');
            $table->date('annual_renewal_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('clients');
    }
};
