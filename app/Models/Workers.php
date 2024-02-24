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

    public function jobs() {
        return $this->hasMany(Jobs::class, 'worker_id');
    }
    
    public function message(){
        return $this->hasMany(Message::class);
    }
}
