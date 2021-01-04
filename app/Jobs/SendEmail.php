<?php

namespace App\Jobs;

use App\Models\SendPulse;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $subject;
    protected $user_email;
    protected $html;

    /**
     * SendEmail constructor.
     * @param $data
     */
    public function __construct($data)
    {
        $this->html = $data['html'];
        $this->subject = $data['subject'];
        $this->user_email = $data['email'];
    }

    /**
     * @throws \Illuminate\Contracts\Redis\LimiterTimeoutException
     */
    public function handle()
    {
        Redis::throttle('send_email')->block(0)->allow(1)->every(5)->then(function () {
            try {
                $sendPulse = new SendPulse();

                $sendPulse->sendEmail($this->html, $this->subject, $this->user_email);
            }
            catch(\Exception $e){
                Log::error($e->getMessage());
            }
        });
    }
}
