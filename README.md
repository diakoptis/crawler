# PHP Product Web Crawler

A simple command-line PHP 8 application that crawls product pages, extracts product information, and stores the results in a SQLite database.

This project was built as a technical assignment to demonstrate clean PHP architecture, error handling, HTML parsing, and basic web scraping.

---

## Features

- Static list of product URLs
- Fetching pages using cURL (PHP 8.4 compatible)
- HTML parsing with `simple_html_dom`
- Extracts:
  - Product title
  - Price (with currency symbol)
  - Availability
- Stores results in a SQLite database
- Logs failed requests and missing fields
- Retry logic for failed HTTP requests
- Clean separation of concerns (Fetcher / Parser / Database / Logger)

---

---

## Setup

### 1. Clone the repository

```bash
git clone https://github.com/diakoptis/crawler.git
cd crawler
```

### 2. Run the crawler

```bash
php crawl.php
```

## Output

### SQLite Database

File: products.sqlite
Table: products

Columns:

- id
- url
- title
- price
- availability
- created_at

You can inspect the database using tools like TablePlus, DB Browser for SQLite, or via the CLI.

## Logs

File: log.txt

Contains:

- Failed HTTP requests
- Missing fields (title, price, availability)
- Parsing or runtime errors
- Error Handling & Retries
- Each failed HTTP request is retried once. If it still fails, the error is logged
- Parsing errors are caught and logged without stopping the crawler
