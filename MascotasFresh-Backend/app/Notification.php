<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Appp\Producto;

class Notification extends Model
{
    //
    protected $fillable = [
        'nombre', 'descripcion','product_id'
    ];

    public function product() {
        return $this->belongsTo(Producto::class);
    }
}
