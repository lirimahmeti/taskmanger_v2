<?php

namespace App\Models;

use App\Models\Clients;
use App\Models\Workers;
use App\Models\Status;
use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jobs extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'worker_id',
        'status_id',
        'description',
        'phone_model',
        'qrcode',
        'imei',
        'kodi',
    ];

    
    public function client() {
        return $this->belongsTo(Clients::class);
    }

    public function worker() {
        return $this->belongsTo(Workers::class);
    }

    public function status() {
        return $this->belongsTo(Status::class);
    }

    public function message(){
        return $this->hasMany(Message::class, 'job_id');
    }
}
