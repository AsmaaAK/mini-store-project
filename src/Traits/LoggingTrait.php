<?php
namespace MiniStore\Traits;

trait LoggingTrait
{
    public function logAction(string $message): void
    {
        // Use the global $config variable
        global $config;

        if (!empty($config['logging']['enabled'])) {
            $logFile = $config['logging']['file'];
            $timestamp = date('Y-m-d H:i:s');
            file_put_contents($logFile, "[$timestamp] $message\n", FILE_APPEND);
        }
    }
}
