<?php

namespace App\Console\Commands;

use App\Notification;
use App\Producto;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CheckLowStock extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:CheckLowStock';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Chequea si el stock de un producto esta por abajo de un limite|10 minutos ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
         Log::info("Cron is working fine!");

        $productos =  Producto::where('cantidad','<',100)->get();
        foreach ($productos as $producto ) {
            $NotificacionExiste = Notification::where('product_id','=', $producto->id)->first();;
            //$ProductoNotificacion = Producto::findOrFail($producto->id);
            if ($NotificacionExiste)
            {
                echo 'No debo hacer una nueva notificacion /n',$NotificacionExiste;
            }
            else
                $notificacion = Notification::create([
                    'nombre' => 'Producto Baja Cantidad',
                    'descripcion' => 'Tarea activada por que el producto tiene una cantidad menor a 10',
                    'product_id' => $producto->id,
                ]);


        }
        $this->info('Demo:Cron Cummand Run successfully!');
    }
}
