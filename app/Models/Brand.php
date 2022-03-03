<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    public function ModelOfPhone()
    {
        return $this->hasMany('App\Models\ModelOfPhone','id_brand','id');
    }
    public function Device()
    {
        return $this->hasManyThrough('App\Models\Device','App\Models\ModelOfPhone','id_brand','id_model','id');
    }
}
