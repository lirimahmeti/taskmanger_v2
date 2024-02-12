<?php

namespace App\Models;

use App\Models\Jobs;
use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workers extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
    ];

    public function job() {
        return $this->hasMany(Jobs::class);
    }
    
    public function message(){
        return $this->hasMany(Message::class);
    }
}
