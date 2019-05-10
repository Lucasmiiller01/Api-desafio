<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    public function Addresses(){
        return $this->belongsToMany(Address::class);
    }
}
