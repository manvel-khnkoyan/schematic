<?php

namespace Peegh\Schematic\Resources;

use Peegh\Schematic\Resource;

class FilePath extends Resource {
    private $path = null;

    function __construct(...$arg){
        parent::__construct(...$arg);
        $path = $arg[0];

        if (!is_file($path)) {
            throw new \Exception(
                "Invalid resource file path: $path"
            );
        }
        $this->path = $path;
    }

    function copyTo($path) {
        copy($this->path, $path);
    }

    function open() {
        return fopen($this->path, 'r');
    }
}
