<?php

namespace App\Models;

use App\Models\Insurance;
use App\Models\Underwriter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model {
    use HasFactory;
    protected $guarded = [];

    public function underwriter() {
        return $this->belongsTo(Underwriter::class);
    }
    public function insurance() {
        return $this->belongsTo(Insurance::class);
    }
}
