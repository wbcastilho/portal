<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;

    use SoftDeletes; 

    protected $fillable = [
        'name', 'email', 'password', 'nivel_id', 'praca_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['deleted_at'];

    public function getFormattedDataAttribute()
    {
        return \Carbon\Carbon::parse($this->created_at)->format('d/m/Y');
    }

    public function nivel()
    {
      return $this->belongsTo('App\Nivel');
    }

    public function praca()
    {
      return $this->belongsTo('App\Praca');
    }

    public function localizacao_equipamentos()
    {
      return $this->hasMany('App\LocalizacaoEquipamentos');
    }

    public function log()
    {
      return $this->hasMany('App\Log');
    }
}
