<?php

use App\Models\Insurance;
use App\Models\Underwriter;
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
            $table->foreignIdFor(Insurance::class);
            $table->foreignIdFor(Underwriter::class);
            $table->string('full_names');
            $table->string('policy_number');
            $table->string('risk_id');
            $table->float("rate", 8, 2);
            $table->bigInteger("sum_insured");
            $table->float("political_risk", 8, 2);
            $table->float("excess_protector", 8, 2);
            $table->float("basic_premium", 8, 2);
            $table->float("annual_total_premium", 8, 2);
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
