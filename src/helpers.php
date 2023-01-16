<?php

if (!function_exists('notifylog')) {
    /**
     * @return \NotifyLog\Laravel\NotifyLog
     */
    function notifylog(): \NotifyLog\Laravel\NotifyLog
    {
        return app('notifylog');
    }
}
