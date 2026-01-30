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
            'title'        => $this->getTitle($dom),
            'price'        => $this->getPrice($dom),
            'availability' => $this->getAvailability($dom),
        ];
    }

    private function getTitle($dom): ?string
    {
        $el = $dom->find('h1.product-title', 0);
        return $el ? trim($el->plaintext) : null;
    }

    private function getPrice($dom): ?string
    {
        $el = $dom->find('span.product-price', 0);

        if (!$el) {
            return null;
        }

        return html_entity_decode(
            trim($el->plaintext),
            ENT_QUOTES | ENT_HTML5,
            'UTF-8'
        );
    }
    private function getAvailability($dom): ?string
    {
        foreach ($dom->find('div.category-list') as $el) {
            $text = trim($el->plaintext);

            if (str_starts_with($text, 'Διαθεσιμότητα:')) {
                return trim(str_replace('Διαθεσιμότητα:', '', $text));
            }
        }

        return null;
    }
}
