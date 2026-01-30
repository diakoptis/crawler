<?php

class Crawler
{
    public function __construct(
        private Fetcher $fetcher,
        private Parser $parser,
        private Database $db,
        private Logger $logger
    ) {}

    public function crawl(array $urls): void
    {
        foreach ($urls as $url) {
            try {
                $html = $this->fetcher->fetch($url, 1);

                if (!$html) {
                    $this->logger->log("Failed to fetch: $url");
                    continue;
                }

                $data = $this->parser->parse($html);

                foreach ($data as $field => $value) {
                    if (!$value) {
                        $this->logger->log("Missing $field for $url");
                    }
                }

                $this->db->save($url, $data);
            } catch (Throwable $e) {
                $this->logger->log("Error for $url: " . $e->getMessage());
            }
        }
    }
}
