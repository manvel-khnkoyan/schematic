<?php

namespace Trebel\Schematic\Tools;

use Exception;
use Trebel\Schematic\Collection;
use Trebel\Schematic\Schema;
use Trebel\Schematic\Field;

class Importer {
    private $map = [];
    private $rootPath = "";

    function __construct($map = []) {
        $this->map = $map;
    }

    private function getClassName($class) {
        $namespaces = explode('\\', $class);
        return end($namespaces);
    }

    private function parseSchema($class, $element) {
        $properties = [];
        foreach ($class::$schema as $schemaClass) {
            $keyName = $this->getClassName($schemaClass);
            if (isset($element[$keyName])) {
                $properties[] = $this->convert(
                    $schemaClass,
                    $element[$keyName],
                    $element[$keyName]['@attributes'] ?? []
                );
            }
        }
        return new $class($properties);
    }

    private function parseList($class, $element, $attributes = []) {
        $list = [];
        foreach ($class::$schema as $schemaClass) {
            $keyName = $this->getClassName($schemaClass);
            if (isset($element[$keyName])) {
                $$list[] = $this->convert(
                    $schemaClass,
                    $element[$keyName],
                    $element[$keyName]['@attributes'] ?? []
                );
            }
        }
        return new $class($list);
    }

    private function parseOperator($class, $element, $attributes = []) {
    }

    private function parseField($class, $element) {
        if (is_scalar($element)) {
            return new $class($element);
        }

        foreach ($element as $key => $el) {
            if ($key !== '@attributes') {
                return new $class(
                    $this->convert($key, $el, $element['@attributes'] ?? [])
                );
            }
        }

        throw new \Exception("Field $class is invalid");
    }

    private function convert($class, $element, $attributes) {
        // When reference
        if (isset($attributes['src'])) {
            list(, $el, $atr)  = $this->loadXml($this->rootPath . '/' . $attributes['src']);
            return $this->convert($class, $el, $atr);
        }
        // When operator
        if (isset($attributes['type']) && $attributes['type'] === 'operator') {
            foreach ($$class::operators as $className) {
                if ($class === $className) {
                    $this->parseOperator($class, $element, $attributes);
                }
            }
            throw new \Exception("Invalid operator for: $class");
        }
        if (is_a($class, 'Trebel\Schematic\Schema', true)) {
            return $this->parseSchema($class, $element, $attributes);
        }
        if (is_a($class, 'Trebel\Schematic\Collection', true)) {
            return $this->parseList($class, $element, $attributes);
        }
        if (is_a($class, 'Trebel\Schematic\Field', true)) {
            return $this->parseField($class, $element, $attributes);
        }

        throw new Exception("Unhandled type: $class");
    }

    private function loadXml($path) {
        $xml = simplexml_load_file($path);
        if (!($xml instanceof \SimpleXMLElement)) {
            throw new \Exception("XML $path is invalid");
        }

        foreach ($xml as $key => $value) {
            if ($key !== '@attributes') {
                return [$key, $value, $xml['@attributes'] ?? []];
            }
        }

        throw new \Exception("XML: $path missing schema");
    }

    public function import($path) {
        $this->rootPath = dirname($path);
        list($key, $element, $attributes)  = $this->loadXml($path);
        // Find Schema Class
        foreach ($this->map as $class) {
            if ($this->getClassName($class) === $key) {
                return $this->convert($class, $element, $attributes);
            }
        }
        // Otherwise throw  exception
        throw new \Exception("Schema not found in $path");        
    }
}
