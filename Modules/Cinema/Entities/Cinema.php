<?php

namespace Modules\Cinema\Entities;

use Illuminate\Database\Eloquent\Model;

class Cinema extends Model
{
    protected $table = 'cinemas';
    protected $fillable = ['slug','user_id','name','location'];

    public function  User(){
        return $this->belongsTo('App\User');
    }

    public function  Showtime(){
        return $this->hasMany()('Modules\Showtime\Entities\Showtime');
    }
}
