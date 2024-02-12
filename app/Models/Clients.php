<?php

namespace App\Models;

use App\Models\Jobs;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'phone',
    ];

    public function job() {
        return $this->hasMany(Jobs::class);
    }

}
