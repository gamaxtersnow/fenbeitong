<?php

namespace fenBeiTong\bridge;

use app\facade\MonologLogger;
use Psr\Log\AbstractLogger;

class Log extends AbstractLogger
{
    public function log($level, $message, array $context = [])
    {
        MonologLogger::channel('fenbeitong')->log($level, $message, $context);
    }
}

