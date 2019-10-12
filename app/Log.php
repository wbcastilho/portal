<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = [
        'acao', 'model', 'user_id', 'model_id'
    ];

    public function user()
    {
      return $this->belongsTo('App\User')->withTrashed(); 
    }   
}
