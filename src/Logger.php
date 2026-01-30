<?php

class Logger
{
    public function __construct(private string $file) {}

    public function log(string $message): void
    {
        file_put_contents(
            $this->file,
            '[' . date('Y-m-d H:i:s') . '] ' . $message . PHP_EOL,
            FILE_APPEND
        );
    }
}
