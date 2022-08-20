<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'status'
    ];

    public function doctors()
    {
        return $this->belongsToMany(Doctor::class);
    }

    public function treatments()
    {
        return $this->hasMany(Treatment::class);
    }
}
