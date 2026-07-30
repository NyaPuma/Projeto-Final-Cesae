<?php

namespace App\Jobs;

use App\Mail\TestMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendTestEmailJob implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(
        public readonly string $email,
        public readonly string $name,
    ) {}

    public function handle(): void
    {
        $mailer = config('services.custom.notification.mailer');
        Mail::mailer($mailer)->to($this->email)->send(new TestMail($this->name));
        Log::info('Test email dispatched via queue', ['email' => $this->email]);
    }
}
