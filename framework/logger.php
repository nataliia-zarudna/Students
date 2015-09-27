<?php

namespace framework;

use Exception;

class Logger {

    private $logFile;

    function __construct($logFile)
    {
        $this->logFile = $logFile;
    }

    /**
     * @return mixed
     */
    public function getLogFile()
    {
        return $this->logFile;
    }

    /**
     * @param mixed $logFile
     */
    public function setLogFile($logFile)
    {
        $this->logFile = $logFile;
    }

    /**
     * @param string $message
     */
    public function debug($message) {
        $this->log("[DEBUG] ".$message);
    }

    /**
     * @param string $message
     * @param Exception $exception
     */
    public function error($message, $exception = null) {
        $this->log("[ERROR] ".$message."\n".$exception->getTraceAsString());
    }

    private function log($message) {
        file_put_contents($this->logFile
            , $message
            , FILE_APPEND);
    }
}