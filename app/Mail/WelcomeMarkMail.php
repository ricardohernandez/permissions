<?php

namespace App\Mail;
use PDF;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class WelcomeMarkMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    public function __construct($user)
    {
         $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $pdf = PDF::loadView('pdf.user',['user' => $this->user , 'title'=> 'titulo']);
      
        return $this->from('noreply@ricardoahernandez.cl')
                ->markdown('mail.welcomeMark', [
                    'user' => $this->user,
                ])
                ->attachData($pdf->output(), "invoice.pdf");
    }
}
