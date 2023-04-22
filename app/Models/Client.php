<?php

namespace App\Models;

use App\Models\Insurance;
use App\Models\Underwriter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model {
    use HasFactory;

    protected $fillable = ["full_names", "policy_number", "risk_id", "insurance_id", "underwriter_id", "sum_insured", "political_risk", "excess_protector", "basic_premium", "annual_total_premium", "annual_expiry_date", "annual_renewal_date"];

    public function underwriter() {
        return $this->belongsTo(Underwriter::class);
    }
    public function insurance() {
        return $this->belongsTo(Insurance::class);
    }
}
