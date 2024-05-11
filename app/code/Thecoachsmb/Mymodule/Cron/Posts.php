<?php

namespace Thecoachsmb\Mymodule\Cron;

class Posts
{
    public function execute()
    {
        try {
            date_default_timezone_set('Asia/Kathmandu'); //set time zone
            $currentDateTime = date('Y-m-d H:i:s'); // Get current date and time
            $message = "hello posts - " . $currentDateTime . "\n";

            // Specify the log file path
            $fileDirectory = BP . '/var/log/test.log';

            // Write the message to the log file
            file_put_contents($fileDirectory, $message, FILE_APPEND);

            return $this;
        } catch (\Exception $e) {
            // Handle any exceptions
            return $this;
        }
    }
}