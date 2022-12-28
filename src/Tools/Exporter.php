<?php

namespace Trebel\Schematic\Tools;

use Exception;
use Trebel\Schematic\Property;

/**
 * Exporter
 */
class Exporter {
    private $schema = null;
    private $path = null;

    /**
     * @param mixed $schema
     */
    function __construct($schema) {
        $this->schema = $schema;
        return $this;
    }

    /**
     * @param array $attributes
     * 
     * @return [type]
     */
    private function createXml($attributes = []) {
        $root = new \SimpleXMLElement(
            '<?xml version="1.0" encoding="UTF-8" ?><Content />'
        );
        foreach ($attributes as $key => $value) {
            $root->addAttribute($key, $value);
        }
        return $root;
    }

    /**
     * @param mixed $xml
     * @param mixed $path
     * 
     * @return [type]
     */
    private function saveXmlToFile($xml, $path) {
        $filePath = $this->path . '/' . $path;
        $directory = dirname($filePath);
        if (!file_exists($directory)) {
            mkdir($directory, 0777, true);
        }
        $xml->asXML($filePath);
    }

    /**
     * @param mixed $obj
     * 
     * @return [type]
     */
    private function getClassName($obj) {
        $namespaces = explode('\\', get_class($obj));
        return end($namespaces);
    }

    /**
     * @param mixed $xml
     * @param mixed $obj
     * 
     * @return [type]
     */
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

    /**
     * @param mixed $root
     * @param mixed $schema
     * 
     * @return [type]
     */
    private function addSchema($root, $schema) {
        if (!isset($schema->ID)) {
            throw new Exception("Oops, Invalid schema for:" . get_class($schema));
        }

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

    /**
     * @param mixed $root
     * @param mixed $list
     * 
     * @return [type]
     */
    private function addList($root, $list) {
        $name = $this->getClassName($list);
        $xml = $root->addChild($name);
        foreach ($list as $item) {
            $this->insertItem($xml, $item);
        }
    }

    /**
     * @param mixed $root
     * @param mixed $field
     * 
     * @return [type]
     */
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

    /**
     * @param mixed $root
     * @param mixed $operator
     * 
     * @return [type]
     */
    private function addOperator($root, $operator) {
        $name = $this->getClassName($operator);
        $value = $operator->innerItem();

        $child = null;
        if ($value instanceof Property) {
            $child = $root->addChild($name);
            $this->insertItem($child, $value);
        } else {
            $child = $root->addChild($name, (string) $value);
        }
    }

    /**
     * @param mixed $path
     * @param array $attributes
     * 
     * @return [type]
     */
    public function export($path) {
        $this->path = dirname($path);
        $xml = $this->createXml();

        $this->addSchema($xml, $this->schema);
        $this->saveXmlToFile($xml, '/index.xml');
    }
}
