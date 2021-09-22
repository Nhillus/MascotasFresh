<?php

namespace App;
use App\Notification;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    //
    protected $fillable = [
        'nombre','cantidad','precio','lote','creado','vencimiento'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    public function notificacion() {
        return $this->belongsTo(Notification::class);
    }
}
