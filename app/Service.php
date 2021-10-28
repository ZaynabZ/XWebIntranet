<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name',
        'supervisor',
    ];

    public function user(){
        return $this->hasMany('App\User');
    }

    public function supervisor(){
        return $this->hasOne('App\User', 'supervisor');
    }
}
