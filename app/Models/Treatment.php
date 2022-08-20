<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;    
    
    protected $fillable = [
        'name',
        'name_as',
        'price',
        'price_c2',
        'price_c3',
        'is_paten',
        'wajib',
        'type',
        'type_bill',
        'poli_id',
    ];

    public function poli()
    {
        return $this->belongsTo(Poli::class);
    }
}
