<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;
    public function ModelOfPhone()
    {
        return $this->belongsTo('App\Models\ModelOfPhone','id_model','id');
    }
}
