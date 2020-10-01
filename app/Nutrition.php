<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nutrition extends Model
{
    //
    protected $table = 'nutritions';
    public function food(){
        return $this->belongsTo(Food::class);
    }
}
