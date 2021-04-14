<?php

namespace App\Infrastructure\Logger;

use Psr\Log\LoggerInterface;

class OpencartLogger implements LoggerInterface
{
    private $handle;

    public function __construct(string $filename)
    {
        $this->handle = fopen(DIR_LOGS . $filename, 'a');
    }

    public function emergency($message, array $context = array())
    {
        // TODO: Implement emergency() method.
    }

    public function alert($message, array $context = array())
    {
        // TODO: Implement alert() method.
    }

    public function critical($message, array $context = array())
    {
        // TODO: Implement critical() method.
    }

    public function error($message, array $context = array())
    {
        // TODO: Implement error() method.
    }

    public function warning($message, array $context = array())
    {
        // TODO: Implement warning() method.
    }

    public function notice($message, array $context = array())
    {
        // TODO: Implement notice() method.
    }

    public function info($message, array $context = array())
    {
        // TODO: Implement info() method.
    }

    public function debug($message, array $context = array())
    {
        // TODO: Implement debug() method.
    }

    public function log($level, $message, array $context = array())
    {
        if (isset($context['exception']) === true) {
            /** @var \ErrorException $exception */
            ['exception' => $exception] = $context;

            $message = 'PHP ' . $exception->getMessage() . ' in ' . $exception->getFile() . ' on line ' . $exception->getLine();
        }

        fwrite($this->handle, date('Y-m-d G:i:s') . ' - ' . print_r($message, true) . "\n");
    }

    public function __destruct()
    {
        fclose($this->handle);
    }
}