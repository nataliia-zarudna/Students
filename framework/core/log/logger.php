<?php

namespace framework\core\log;

use Exception;

class Logger {

    private $logFile;

    /**
     * @param string $logFile
     */
    function __construct($logFile)
    {
        $this->logFile = $logFile;
    }

    /**
     * @return string
     */
    public function getLogFile()
    {
        return $this->logFile;
    }

    /**
     * @param string $logFile
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

    /**
     * @param string $message
     */
    private function log($message) {
        file_put_contents($this->logFile
            , $message."\n"
            , FILE_APPEND);
    }
}