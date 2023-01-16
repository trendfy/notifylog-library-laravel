<?php

namespace NotifyLog\Laravel\Tests;

use Illuminate\Console\Command;
use Illuminate\Contracts\Config\Repository;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notifylog:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send event to your NotifyLog dashboard.';

    /**
     * Execute the console command.
     *
     * @param Repository $config
     * @return void
     * @throws \Throwable
     */
    public function handle(Repository $config)
    {

        $this->line("Let me test your NotifyLog integration...");

        try {
            proc_open("", [], $pipes);
        } catch (\Throwable $exception) {
            $this->warn("❌ proc_open function disabled.");
            return;
        }

        !empty($config->get('notifylog.token'))
            ? $this->info('✅ NotifyLog account token configured.')
            : $this->warn('❌ NotifyLog account token not specified. Make sure you specify the NOTIFYLOG_ACCOUNT_TOKEN in your .env file.');

        function_exists('curl_version')
            ? $this->info('✅ CURL extension is enabled.')
            : $this->warn('❌ CURL is disabled so your app could not be able to send data to NotifyLog.');

        $this->line('Sending test event data to NotifLog');

        $event = [
            "name" =>  "NotifyLog Laravel Library",
            "description" =>  'Test Event',
            "channel" =>  "from-laravel",
            "icon" =>  "💬",
            "notify" =>  false,
            "tags" => [
                "my-tag" =>  "my-tag-value",
            ],
            "message" =>
            "[Laravel](https://laravel.com)",
        ];


        notifylog()->publish($event);

        $this->info('✅ All good!');
        $this->line('Check for the Event in https://app.notifylog.com/');
        $this->line('Look for the #from-laravel channel');
    }
}
