<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SubmissionSent extends Mailable
{
    use Queueable, SerializesModels;

    private $orderOfServicePdf;

    private $userAttachment;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($orderOfServicePdf = null, $userAttachment = null)
    {
        $this->orderOfServicePdf = $orderOfServicePdf;
        $this->userAttachment = $userAttachment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.submissionsent')
                    ->attachData($this->orderOfServicePdf, 'order-of-service.pdf', [
                        'mime' => 'application/pdf',
                    ]);
        ;
    }
}
