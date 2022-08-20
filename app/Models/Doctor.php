<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'name_as',
        'title',
        'is_specialist'
    ];

    public function polis()
    {
        return $this->belongsToMany(Poli::class);
    }
}
