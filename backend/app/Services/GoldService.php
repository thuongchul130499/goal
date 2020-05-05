<?php
namespace App\Services;

class GoldService {

    protected $url;

    public function __contructor($url)
    {
        $this->url = $url;
    }

    public function getExchangeRate()
    {
        $content = file_get_contents($this->url ?? 'http://www.sjc.com.vn/xml/tygiavang.xml');
        $xml= simplexml_load_string($content);

        return $xml;
    }
}