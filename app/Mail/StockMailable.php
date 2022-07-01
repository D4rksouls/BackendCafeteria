<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StockMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = 'Stock insuficiente . $variable';

    public $product;
    public $stock;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($product,$stock)
    {
        $this->product = $product;
        $this->stock = $stock;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.stock');
    }
}
