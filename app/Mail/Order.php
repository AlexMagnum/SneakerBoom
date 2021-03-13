<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Order extends Mailable
{
    use Queueable, SerializesModels;

    public $order, $cart_items, $id;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $cart_items, $id)
    {
        $this->order = $order;
        $this->cart_items = $cart_items;
        $this->id = $id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('vendor.Mail.order')
            ->subject('Замовлення на сайті sneakerboom.ho.ua')
            ->with([
                'order' => $this->order,
                'cartItems' => $this->cart_items,
                'id' => $this->id
            ]);
    }
}
