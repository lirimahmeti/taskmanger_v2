<?php

namespace App\Models;

use App\Models\Workers;
use App\Models\Jobs;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    
    protected $table = 'message';

    protected $column = 'job_id';

    protected $fillable = [
        'job_id',
        'worker_id',
        'mesazhi',
    ];

    public function job(){
        return $this->belongsToMany(Jobs::class);
    }

    public function worker(){
        return $this->belongsToMany(Workers::class);
    }
}
