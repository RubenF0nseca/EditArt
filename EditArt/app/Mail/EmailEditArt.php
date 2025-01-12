<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EmailEditArt extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $content;
    public $attachment;

    /**
     * Create a new message instance.
     *
     * @param string $subject
     * @param string $content
     * @param \Illuminate\Http\UploadedFile|null $attachment
     */
    public function __construct($subject, $content, $attachment = null)
    {
        $this->subject = $subject;
        $this->content = $content;
        $this->attachment = $attachment;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->subject($this->subject) // Set the email subject
        ->view('mails.client_notification') // Specify the email Blade view
        ->with([
            'content' => $this->content, // Pass content to the view
        ]);

        // Attach the file if provided
        if ($this->attachment) {
            $email->attach($this->attachment->getRealPath(), [
                'as' => $this->attachment->getClientOriginalName(),
                'mime' => $this->attachment->getMimeType(),
            ]);
        }

        return $email;
    }
}
