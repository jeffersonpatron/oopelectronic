<?php

namespace WebApp\Helper;

class Files
{

    public static function writeFileSorted(array $list) : void
    {
        if (empty($list)) {
            return;
        }

        $path = __DIR__ . '/../../files/';
        $filename = 'electronic_items_sorted.csv';
        $file = $path . $filename;

        if (file_exists($file)) {
            unlink($file);
        }

        $header = "Description;Extras;Price;IsWired" . PHP_EOL;
        file_put_contents($file, $header);
        foreach ($list as $data) {
            $line = "";
            $price = "$".$data->getPrice();
            $line .= "{$data->getType()};;{$price};" . PHP_EOL;

            if ($data::EXTRAS_QUANTITY != 0 && !empty($data->getExtras())) {
                foreach ($data->getExtras() as $extra) {
                    $price = "$".$extra->getPrice();
                    $line .= "{$data->getType()};{$extra->getType()};{$price};{$extra->getWired()}" . PHP_EOL;
                }
            }
            file_put_contents($file, $line, FILE_APPEND);
        }
    }
}   