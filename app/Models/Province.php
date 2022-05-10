<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $table = 'devvn_quanhuyen';
    protected $primaryKey = 'maqh';
    // protected $with = ['city'];
    // public function city()
    // {
    //     return $this->belongsTo(City::class, 'matp');
    // }
}