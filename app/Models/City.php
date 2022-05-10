<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $table = 'devvn_tinhthanhpho';
    protected $primaryKey = 'matp';
    // protected $with = ['province'];

    public function province()
    {
        return $this->hasMany(Province::class, 'maqh');
    }
}