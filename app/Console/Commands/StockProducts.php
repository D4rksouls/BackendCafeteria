<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use app\Models\Product;

class StockProducts extends Command
{
    /**
     * El nombre y la firma del comando de la consola.
     *
     * @var string
     */
    protected $signature = 'NumberOfStocks:send';

    /**
     * La descripción del comando de la consola.
     *
     * @var string
     */
    protected $description = 'Send an e-mail if any of the product stocks is lower than the minimum required.';

    /**
     * Ejecuta el comando de la consola.
     *
     * @return int
     */
    public function handle()
    {
        foreach ($products as $product) {
            if($product->stock < 10){

                Mail::to()->send(new StockMailable($product, $product->stock));
            }
        }
        return 0;
    }
}
