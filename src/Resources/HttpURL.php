<?php

namespace Peegh\Schematic\Resources;

use Peegh\Schematic\Resource;

class HttpURL extends Resource {
    private $url = null;

    function __construct(...$arg){
        parent::__construct(...$arg);
        $url = $arg[0];

        if (!preg_match('/(http|https):\/\/[a-z0-9]+[a-z0-9_\/]*/', $url)) {
            throw new \Exception(
                "Invalid resource file url: $url"
            );
        }
        $this->url = $url;
    }

    function copyTo($url) {
        copy($this->url, $url);
    }

    function open() {
        return fopen($this->url, 'r');
    }
}
