<?php

namespace NotifyLog\Laravel;

use NotifyLog\Laravel\OS;


/**
 *  NotifyLog Class for Laravel
 *
 *  @author Mauro Marchiori
 */
class NotifyLog
{

    /**
     * Agent configuration.
     *
     * @var Configuration
     */
    protected $configuration;

    /**
     * Logger constructor.
     *
     * @param Configuration $configuration
     * @throws InvalidArgumentException
     */
    public function __construct(Configuration $configuration)
    {
        if (!function_exists('proc_open')) {
            throw new \InvalidArgumentException("PHP function 'proc_open' is not available.");
        }

        $this->configuration = $configuration;
    }

    public function publish($event)
    {

        $event_json = \json_encode($event);
        $this->buildCurlCommandAndRun($event_json);
    }

    private function buildCurlCommandAndRun($event_json)
    {
        $curl_path = "curl";

        // How to deal with Silent and Output
        if (OS::isWin()) {
            $curl = $curl_path . " --silent --output nul";
        } else {
            $curl = $curl_path;
        }

        // Build cURL command
        $curl .= " -X POST --ipv4 --max-time 5";

        $curl .= " --header \"Content-Type: application/json; charset=utf-8\"";
        $curl .= " --header \"Authorization: {$this->configuration->getAccountToken()}\"";
        $curl .= " --header \"X-Version: {$this->configuration->getVersion()}; charset=utf-8\"";
        $curl .= " --header \"X-ClientPlatform: {$this->configuration->getPlatform()}; charset=utf-8\"";

        $curl .= " --data '{$event_json}' {$this->configuration->getUrl()}";

        // How to Run Command based on OS
        if (OS::isWin()) {
            $cmd = 'start /B "' . $curl . '"';
            $cmd = $curl;
        } else {
            $cmd = "({$curl} > /dev/null 2>&1)&";
        }

        proc_close(proc_open($cmd, [], $pipes));
    }
}
