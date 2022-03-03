<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelOfPhone extends Model
{
    use HasFactory;
    public function Brand(){
        return $this->belongsTo('App\Models\Brand','id_brand','id');
    }
    public function Device()
    {
        return $this->hasMany('App\Models\Device','id_model','id');
    }
}
