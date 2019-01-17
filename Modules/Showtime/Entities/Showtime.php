<?php

namespace Modules\Showtime\Entities;

use Illuminate\Database\Eloquent\Model;

class Showtime extends Model
{
    protected $table = 'show_times';
    protected $fillable = ['user_id','slug','movie_id','cinema_id','date','time'];

    public function  User(){
        return $this->belongsTo('App\User');
    }

    public function  Movies(){
        return $this->belongsTo('Modules\Movies\Entities\Movie','movie_id');
    }

    public function  Cinema(){
        return $this->belongsTo('Modules\Cinema\Entities\Cinema');
    }
}
