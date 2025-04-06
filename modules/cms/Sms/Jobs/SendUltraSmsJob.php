<?php

namespace CMS\Sms\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use CMS\Sms\Services\SmsService;

class SendUltraSmsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 5;

    private $method;
    private $data;
    private $receptor;

    public function __construct($method,$data,$receptor)
    {
        $this->method = $method;
        $this->data = $data;
        $this->receptor = $receptor;
    }


    public function handle()
    {
        SmsService::ultra($this->method, $this->data, $this->receptor);
    }
}
