<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    public function Addresses(){
        return $this->belongsToMany(Address::class);
    }
}
