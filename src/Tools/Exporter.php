<?php

namespace Peeghe\Schematic\Tools;

use Exception;
use Peeghe\Schematic\Property;
use Peeghe\Schematic\Operator;

class Exporter 
{
    private $schema = null;
    private $path = null;

    function __construct($schema) {
        $this->schema = $schema;
    }

    private function getClass($obj) {
        $namespaces = explode('\\', get_class($obj));
        return end($namespaces);
    }

    private  function addToXml($xml, $obj) {
        if (is_a($obj, 'Peeghe\Schematic\Schema')) {
            return $this->addSchema($xml, $obj);
        }
        if (is_a($obj, 'Peeghe\Schematic\Collection')) {
            return $this->addList($xml, $obj);
        } 
        if (is_a($obj, 'Peeghe\Schematic\Operator')) {
            return $this->addOperator($xml, $obj);
        } 
        if (is_a($obj, 'Peeghe\Schematic\Field')) {
            return $this->addField($xml, $obj);
        } 

        throw new Exception(
            "Oops, unserialize type provided: "
        );
    }

    private function createXmlContent($attributes = []) {
        $root = new \SimpleXMLElement(
            '<?xml version="1.0" encoding="UTF-8" ?><Content />'
        );
        foreach ($attributes as $key => $value) {
            $root->addAttribute($key, $value);
        }
        return $root;
    }

    private function saveToFile($xml, $path) {
        $filePath = $this->path. '/' . $path;
        $directory = dirname($filePath);
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }
        $xml->asXML($filePath);
    }

    private function addSchema($root, $schema) {
        $name = $this->getClass($schema);
        $path = $name . '/' . $schema->id . '.xml';

        $child = $root->addChild($name);
        $child->addAttribute('src', $path);

        $link = $this->createXmlContent();
        foreach ($schema as $key => $value) {
            if () {
                
            }

            if (is_scalar($value->getValue())) {
                $link->addChild($key, $value);
            } else {
                $this->addToXml($link->addChild($key), $value);
            }
        }

        $this->saveToFile($link, $path);
    }

    private function addList($root, $list) {
        $name = $this->getClass($list);
        $xml = $root->addChild($name);
        foreach ($list as $item) {
            $this->addToXml($xml, $item);
        }
    }

    private function addField($root, $field) {
        $name = $this->getClass($field);

        if ($field->getValue() instanceof Property) {
            $this->addToXml($root, $value);
        } else {
            $root->addChild($name, (string) $value);
        }

        $root->addChild($name, $field->__toString());
    }

    private function addOperator($root, $operator) {
        $name = $this->getClass($operator);
        $value  = $operator->getValue();

        if ($value instanceof Property) {
            $this->addToXml($root, $value);
        } else {
            $root->addChild($name, (string) $value);
        }
    }

    public function export($path, $attributes = []) {
        $this->path = $path;
        $xml = $this->createXmlContent($attributes);

        $this->addSchema($xml, $this->schema);
        $this->saveToFile($xml, '/index.xml');
    }
}
