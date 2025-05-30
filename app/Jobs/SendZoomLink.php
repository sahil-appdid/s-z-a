<?php
namespace App\Jobs;

use App\Mail\SendZoomMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class SendZoomLink implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $url;
    // public $zoomLink;
    public $studentsEmail;

    // public function __construct($url, $studentsEmail, $zoomLink)
    public function __construct($url, $studentsEmail)
    {
        $this->url           = $url;
        $this->studentsEmail = $studentsEmail;

        \Log::info("Log from job".$this->studentsEmail->email);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to($this->studentsEmail->email)->send(new SendZoomMail($this->studentsEmail->name, $this->url));
    }
}
