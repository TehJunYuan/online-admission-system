<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ApplicationApprovalEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $data = [];
    
    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('ccooas@sc.edu.my','CCO Admin')->subject($this->data['subject'])->view('oas.admin.email.applicationApprovalEmail')->with('data', $this->data);
    }
}
