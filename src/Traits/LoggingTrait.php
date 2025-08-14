<?php
namespace MiniStore\Traits;

trait LoggingTrait
{
    protected function logAction($message)
    {
        if (config('logging.enabled')) {
            $logFile = config('logging.file');
            $timestamp = date('Y-m-d H:i:s');
            file_put_contents($logFile, "[$timestamp] $message\n", FILE_APPEND);
        }
    }
}