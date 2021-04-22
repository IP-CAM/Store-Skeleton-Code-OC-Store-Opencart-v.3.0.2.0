<?php

namespace App\Infrastructure\Logger;

use Psr\Log\LoggerInterface;
use RuntimeException;

class OpencartLogger implements LoggerInterface
{
    /**
     * @var false|resource
     */
    private $handle;

    private array $whiteList;

    public function __construct(string $filename)
    {
        $this->handle = fopen(DIR_LOGS . $filename, 'a');
        $this->whiteList = explode(',', env('LOG_WHITE_LIST', 'emergency,alert,critical,error,warning,notice,info,debug,log'));
    }

    public function emergency($message, array $context = array())
    {
        fwrite($this->handle, $this->getLogFormat($message, $context['exception'] ?? null));
    }

    public function alert($message, array $context = array())
    {
        fwrite($this->handle, $this->getLogFormat($message, $context['exception'] ?? null));
    }

    public function critical($message, array $context = array())
    {
        fwrite($this->handle, $this->getLogFormat($message, $context['exception'] ?? null));
    }

    public function error($message, array $context = array())
    {
        fwrite($this->handle, $this->getLogFormat($message, $context['exception'] ?? null));
    }

    public function warning($message, array $context = array())
    {
        fwrite($this->handle, $this->getLogFormat($message, $context['exception'] ?? null));
    }

    public function notice($message, array $context = array())
    {
        fwrite($this->handle, $this->getLogFormat($message, $context['exception'] ?? null));
    }

    public function info($message, array $context = array())
    {
        fwrite($this->handle, $this->getLogFormat($message, $context['exception'] ?? null));
    }

    public function debug($message, array $context = array())
    {
        fwrite($this->handle, $this->getLogFormat($message, $context['exception'] ?? null));
    }

    public function log($level, $message, array $context = array())
    {
        if (in_array($level, $this->whiteList) === false) {
            return;
        }

        if (method_exists($this, $level) === false) {
            $context['exception'] = new RuntimeException(sprintf('Method log "%s" not found!', $level));
            $this->error($context['exception']->getMessage(), $context);

            return;
        }

        $this->{$level}($message, $context);
    }

    private function getLogFormat(string $message, ?\Throwable $exception = null): string
    {
        if ($exception !== null) {
            $message = 'PHP ' . $exception->getMessage() . ' in ' . $exception->getFile() . ' on line ' . $exception->getLine();
        }

        return date('Y-m-d G:i:s') . ' - ' . print_r($message, true) . "\n";
    }

    public function __destruct()
    {
        fclose($this->handle);
    }
}
