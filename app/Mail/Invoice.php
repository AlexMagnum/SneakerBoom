<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Invoice extends Mailable
{
    use Queueable, SerializesModels;

    public $order, $id;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($order, $id)
    {
        $this->order = $order;
        $this->id = $id;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('vendor.Mail.invoice')
            ->subject('Sneakerboom реквізити на оплату замовлення')
            ->with([
                'order' => $this->order,
                'id' => $this->id
            ]);
    }
}
