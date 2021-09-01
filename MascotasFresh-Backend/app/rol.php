<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;

class rol extends Model
{
    //
    protected $fillable = [
        'nombre_rol', 'descripcion'
    ];

    public function usuarios() 
    {
        return $this->belongsToMany(User::class);
    }
}
