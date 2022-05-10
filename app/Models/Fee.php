<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;
    protected $table = 'fees';
    protected $fillable = ['fee_matp', 'fee_maqh', 'fee_xaid', 'price'];
    protected $with = ['city', 'province', 'ward'];
    public function city()
    {
        return $this->belongsTo(City::class, 'fee_matp');
    }
    public function province()
    {
        return $this->belongsTo(Province::class, 'fee_maqh');
    }
    public function ward()
    {
        return $this->belongsTo(Ward::class, 'fee_xaid');
    }
}
