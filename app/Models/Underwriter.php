<?php

namespace App\Models;

use App\Models\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Underwriter extends Model {
    use HasFactory;
    protected $guarded = [];

    public function client() {
        return $this->hasOne(Client::class);
    }
}
