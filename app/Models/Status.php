<?php

namespace App\Models;

use App\Models\Jobs;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;
    protected $table = 'status';

    protected $fillable = [
        'name',
        'color',
        'active',
    ];

    public function jobs(){
        return $this->hasMany(Jobs::class);
    }

}
