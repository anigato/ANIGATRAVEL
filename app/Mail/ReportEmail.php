<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ReportEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('anigato@gmail.com')
                ->view('report.reportemail')
                ->with([
                    'nama'=>'Khoerul Anam',
                    'website'=>'https://anigato.net',
                    'youtube'=>'youtube.com/anigato',
                ])
                ->attach(public_path('/storage/images').'/1580199624_5e2feec8ca30d.jpg',[
                    'as'=>'1580199624_5e2feec8ca30d.jpg',
                    'mime'=>'image/jpeg',
                ]);
    }
}
