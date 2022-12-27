<?php

namespace Trebel\Schematic\Tools;

use Exception;
use Trebel\Schematic\Collection;
use Trebel\Schematic\Operator;
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

    private function parseSchema($class, $element, $attributes = []) {
        $properties = [];
        foreach ($class::$__schema as $schemaClass) {
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
        $properties = [];
        foreach ($class::$__schema as $schemaClass) {
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

    private function parseOperator($class, $element, $attributes = []) {

    }

    private function parseField($class, $element, $attributes = []) {

    }

    private function convert($class, $element, $attributes) {
        if (!($class instanceof Schema)) {
            throw new \Exception("$class should be Schema");
        }

        if (isset($attributes['src'])) {
            list(, $el, $atr)  = $this->loadXml($this->rootPath . '/' . $attributes['src']);
            return $this->convert($class, $el, $atr);
        }

        if ($class instanceof Schema) {
            return $this->parseSchema($class, $element, $attributes);
        }
        if ($class instanceof Operator) {
            return $this->parseList($class, $element, $attributes);
        }
        if ($class instanceof Collection) {
            return $this->parseOperator($class, $element, $attributes);
        }
        if ($class instanceof Field) {
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
        list($keyName, $element, $attributes)  = $this->loadXml($path);

        // Find Schema Class
        $class = null;
        foreach ($this->map as $className) {
            if ($this->getClassName($class) === $keyName) {
                $class = $className;
            }
        }

        if (!$class) {
            throw new \Exception("Schema [keyName] not found in Map");
        }

        return $this->convert($class, $element, $attributes);
    }
}
