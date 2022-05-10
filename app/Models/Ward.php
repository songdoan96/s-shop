<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;
    protected $table = 'devvn_xaphuongthitran';
    protected $primaryKey = 'xaid';
    protected $with = ['province'];

    public function province()
    {
        return $this->belongsTo(Province::class, 'maqh');
    }
}