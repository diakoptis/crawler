<?php

require_once __DIR__ . '/src/Fetcher.php';
require_once __DIR__ . '/src/Parser.php';
require_once __DIR__ . '/src/Database.php';
require_once __DIR__ . '/src/Logger.php';
require_once __DIR__ . '/src/Crawler.php';

$urls = require __DIR__ . '/urls.php';

$crawler = new Crawler(
    new Fetcher(),
    new Parser(),
    new Database(__DIR__ . '/products.sqlite'),
    new Logger(__DIR__ . '/log.txt')
);

$crawler->crawl($urls);

echo "Crawling completed\n";
