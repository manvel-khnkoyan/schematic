<?php

namespace Trebel\Schematic\Tools;

use Exception;
use Trebel\Schematic\Property;

class Exporter {
    private $schema = null;
    private $path = null;

    function __construct($schema) {
        $this->schema = $schema;
    }

    private function createXml($attributes = []) {
        $root = new \SimpleXMLElement(
            '<?xml version="1.0" encoding="UTF-8" ?><Content />'
        );
        foreach ($attributes as $key => $value) {
            $root->addAttribute($key, $value);
        }
        return $root;
    }

    private function saveXmlToFile($xml, $path) {
        $filePath = $this->path . '/' . $path;
        $directory = dirname($filePath);
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }
        $xml->asXML($filePath);
    }

    private function getClassName($obj) {
        $namespaces = explode('\\', get_class($obj));
        return end($namespaces);
    }

    private  function insertItem($xml, $obj) {
        if (is_a($obj, 'Trebel\Schematic\Schema')) {
            return $this->addSchema($xml, $obj);
        }
        if (is_a($obj, 'Trebel\Schematic\Collection')) {
            return $this->addList($xml, $obj);
        }
        if (is_a($obj, 'Trebel\Schematic\Operator')) {
            return $this->addOperator($xml, $obj);
        }
        if (is_a($obj, 'Trebel\Schematic\Field')) {
            return $this->addField($xml, $obj);
        }

        throw new Exception(
            "Oops, unknown type provided :" . get_class($obj)
        );
    }

    private function addSchema($root, $schema) {
        $name = $this->getClassName($schema);
        $path = $name . '/' . $schema->ID . '.xml';

        $child = $root->addChild($name);
        $child->addAttribute('src', $path);

        $link = $this->createXml();
        $linkChild = $link->addChild($name);

        foreach ($schema as $value) {
            $this->insertItem($linkChild, $value);
        }

        $this->saveXmlToFile($link, $path);
    }

    private function addList($root, $list) {
        $name = $this->getClassName($list);
        $xml = $root->addChild($name);
        foreach ($list as $item) {
            $this->insertItem($xml, $item);
        }
    }

    private function addField($root, $field) {
        $name = $this->getClassName($field);
        $value = $field->innerItem();

        if ($value instanceof Property) {
            $child = $root->addChild($name);
            $this->insertItem($child, $value);
        } else {
            $root->addChild($name, (string) $value);
        }
    }

    private function addOperator($root, $operator) {
        $name = $this->getClassName($operator);
        $value = $operator->innerItem();

        if ($value instanceof Property) {
            $child = $root->addChild($name);
            $child->addAttribute('type', 'operator');
            $this->insertItem($child, $value);
        } else {
            $root->addChild($name, (string) $value);
        }
    }

    public function export($path, $attributes = []) {
        $this->path = $path;
        $xml = $this->createXml($attributes);

        $this->addSchema($xml, $this->schema);
        $this->saveXmlToFile($xml, '/index.xml');
    }
}
