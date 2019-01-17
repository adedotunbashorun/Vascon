<?php

namespace Modules\Movies\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Movie extends Model
{
    protected $table = 'movies';
    protected $fillable = ['slug','user_id','title','release_date','genre','duration','language','description'];

    public function  User(){
        return $this->belongsTo('Modules\User\Entities\User');
    }

    public function  Showtime(){
        return $this->hasMany('Modules\Showtime\Entities\Showtime');
    }


}
