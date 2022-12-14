<?php

namespace Trebel\Schematic\Tools;


/**
 * Importer
 */
class Importer {
    private $map = [];
    private $rootPath = "";

    /**
     * @param array $map
     */
    function __construct($map = []) {
        $this->map = $map;
        return $this;
    }

    /**
     * @param mixed $class
     * 
     * @return [type]
     */
    private function getClassName($class) {
        $namespaces = explode('\\', $class);
        return end($namespaces);
    }

    /**
     * @param mixed $element
     * 
     * @return [type]
     */
    private function isScalar($element) {
        return !count($element->children());
    }

    /**
     * @param mixed $xml
     * 
     * @return [type]
     */
    private function getInnerItem($xml) {
        foreach ($xml->children() as $item) {
            return $item;
        }
        return null;
    }

    /**
     * @param mixed $class
     * @param mixed $element
     * 
     * @return [type]
     */
    private function parseSchema($class, $element) {
        $properties = [];
        foreach ($class::$schema as $schemaClass) {
            $key = $this->getClassName($schemaClass);
            if (isset($element->{$key})) {
                $properties[] = $this->convert(
                    $schemaClass,
                    $element->{$key}
                );
            }
        }
        return new $class($properties);
    }

    /**
     * @param mixed $class
     * @param mixed $element
     * 
     * @return [type]
     */
    private function parseList($class, $element) {
        $list = [];
        foreach ($element->children() as $el) {
            if ($this->getClassName($class::$type) === $el->getName()) {
                $list[] = $this->convert($class::$type, $el);
                continue;
            }

            // Otherwise it should be operator
            foreach ($class::$operators as $operator) {
                if ($this->getClassName($operator) === $el->getName()) {
                    $list[] = new $operator(
                        $this->convert($class::$type, $this->getInnerItem($el))
                    );
                    continue 2;
                }
            }

            throw new \Exception('Invalid list item: [' . $el->getName() . ']');
        }

        return new $class($list);
    }

    /**
     * @param mixed $class
     * @param mixed $element
     * 
     * @return [type]
     */
    private function parseField($class, $element) {
        if ($this->isScalar($element)) {
            return new $class((string) $element);
        }

        // Then it should be only operator
        foreach ($element->children() as $el) {
            foreach ($class::$operators ?? [] as $operator) {
                if ($this->getClassName($operator) === $el->getName()) {
                    return new $class(
                        new $operator((string) $el)
                    );
                }
            }
        }

        throw new \Exception("Field $class is invalid");
    }

    /**
     * @param mixed $class
     * @param mixed $element
     * 
     * @return [type]
     */
    private function convert($class, $element) {
        // When reference
        $attributes = iterator_to_array($element->attributes());
        if (isset($attributes['src'])) {
            $el = $this->loadXml($this->rootPath . '/' . ((string) $attributes['src']));
            return $this->convert($class, $el);
        }
        if (is_a($class, 'Trebel\Schematic\Schema', true)) {
            return $this->parseSchema($class, $element);
        }
        if (is_a($class, 'Trebel\Schematic\Collection', true)) {
            return $this->parseList($class, $element);
        }
        if (is_a($class, 'Trebel\Schematic\Field', true)) {
            return $this->parseField($class, $element);
        }

        throw new \Exception("Unhandled type: $class");
    }

    /**
     * @param mixed $path
     * 
     * @return [type]
     */
    private function loadXml($path) {
        $xml = simplexml_load_file($path);
        if (!($xml instanceof \SimpleXMLElement)) {
            throw new \Exception("XML $path is invalid");
        }

        foreach ($xml->children() as $el) {
            return $el;
        }

        throw new \Exception("XML: $path missing schema");
    }

    /**
     * @param mixed $path
     * 
     * @return [type]
     */
    public function import($path) {
        $this->rootPath = dirname($path);
        $element  = $this->loadXml($path);
        // Find Schema Class
        foreach ($this->map as $class) {
            if ($this->getClassName($class) === $element->getName()) {
                return $this->convert($class, $element);
            }
        }
        // Otherwise throw  exception
        throw new \Exception("Schema not found in $path");
    }
}
