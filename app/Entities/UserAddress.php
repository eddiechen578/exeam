<?php

namespace App\Entities;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $guarded = [];

    protected $dates = ['last_used_at'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getFullAddressAttribute(){
        return "{$this->zip_code} {$this->city}{$this->district}{$this->address}";
    }
}
