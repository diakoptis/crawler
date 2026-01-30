<?php

require_once __DIR__ . '/../vendor/simple_html_dom.php';

class Parser
{
    public function parse(string $html): array
    {
        $dom = str_get_html($html);

        if (!$dom) {
            throw new Exception('Invalid HTML');
        }

        return [
            'title' => $this->getText($dom, 'h1.product-title'),
            'price' => $this->getText($dom, '.price'),
            'availability' => $this->getText($dom, '.availability'),
        ];
    }

    private function getText($dom, string $selector): ?string
    {
        $el = $dom->find($selector, 0);
        return $el ? trim($el->plaintext) : null;
    }
}
