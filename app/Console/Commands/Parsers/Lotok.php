<?php

namespace App\Console\Commands\Parsers;

use DiDom\Document;
use Illuminate\Console\Command;

class Lotok extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parser:lotok';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse - https://lotok.ua/discount/cat1';

    protected function priceConvertor($html) {
        $price = $html;

        $price = str_replace('<sup>', '.', $price);
        $price = floatval(strip_tags($price));

        return $price;
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $document = new Document('https://lotok.ua/discount/cat1', true);

        $main_slider_products = $document->find('.products-slider__slide');

        $thumb_slider_products = $document->find('.products-thumb-slider__slide');

        $items = [];

        foreach ($main_slider_products as $element) {
            $items['main_slider'][] = [
                'img' => $element->find('img')[0]->getAttribute('src'),
                'name' => $element->find('.title')[0]->text(),
                'weight' => $element->find('.js-weight')[0]->text(),
                'new_price' => $this->priceConvertor($element->find('.js-current')[0]->html()),
                'old_price' => $this->priceConvertor($element->find('.js-old')[0]->html()),
            ];
        }

        foreach ($thumb_slider_products as $element) {
            $items['thumb_slider'][] = [
                'img' => $element->find('img')[0]->getAttribute('src'),
                'name' => $element->find('.title')[0]->text(),
                'weight' => $element->find('.js-weight')[0]->text(),
                'new_price' => $this->priceConvertor($element->find('.js-current')[0]->html()),
                'old_price' => $this->priceConvertor($element->find('.js-old')[0]->html()),
            ];
        }

        $json = json_encode($items, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);

        $name = 'discount-' . date("d.m.Y") . '.json';

        $file_path = 'public/lotok/' . $name;
        if (!is_dir(dirname($file_path))) {
            mkdir(dirname($file_path), 0755, true);
        }

        file_put_contents($file_path, $json);

        $this->info('File created successfully! Link to it - ' . env('APP_URL') . '/lotok/' . $name);
    }
}
