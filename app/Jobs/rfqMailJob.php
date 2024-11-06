<?php

namespace App\Jobs;

use App\Mail\rfqMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class rfqMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data = null;
    public $request = null;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($_data, $_request)
    {
        $this->data = $_data;
        $this->request = $_request;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::to([$this->data[0]->email, $this->request->remail])->send(new rfqMail($this->request));
    }
}
