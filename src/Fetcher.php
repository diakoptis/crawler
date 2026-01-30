<?php

class Fetcher
{
    public function fetch(string $url, int $retries = 1): ?string
    {
        $attempt = 0;

        while ($attempt <= $retries) {

            $ch = curl_init($url);

            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_TIMEOUT => 15,
                CURLOPT_USERAGENT => 'PHP Product Crawler/1.0',
            ]);

            $html   = curl_exec($ch);
            $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            if ($html !== false && $status === 200) {
                return $html;
            }

            $attempt++;
        }

        return null;
    }
}
