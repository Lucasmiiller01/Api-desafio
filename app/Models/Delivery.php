<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    public function Addresses(){
        return $this->belongsToMany('App\Models\Address', 'delivery_addresses', 'delivery_id', 'address_id')->withPivot('type');
    }

    public function Client(){
        return $this->belongsTo('App\Models\Client', 'client_id');
    }
}
