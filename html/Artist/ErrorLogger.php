
<?php
class ErrorLogger {
    private $logFile;

    public function __construct($logFile = 'error_log.txt') {
        $this->logFile = $logFile; // Set the log file location
    }

    public function logError($errorMessage) {
        $timestamp = date('Y-m-d H:i:s'); // Get the current timestamp
        $formattedMessage = "[$timestamp] ERROR: $errorMessage" . PHP_EOL; // Format the error message
        
        // Append the error message to the log file
        file_put_contents($this->logFile, $formattedMessage, FILE_APPEND);
    }
}
?>


