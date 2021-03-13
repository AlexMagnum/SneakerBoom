<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactAnswer extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $message;
    public $question;

    public function __construct($message, $question)
    {
        $this->message = $message;
        $this->question = $question;
    }

    /**
     * Build the message.
     *
     * @return $this
     */

    public function build()
    {
        return $this->view('vendor.Mail.answer')
            ->subject('Відповідь на звернення на сайті sneakerboom.ho.ua')
            ->with([
                'msg' => $this->message,
                'question' => $this->question,
            ]);
    }
}
