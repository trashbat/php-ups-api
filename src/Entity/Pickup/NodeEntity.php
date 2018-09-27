<?php

namespace Ups\Entity\Pickup;

use DOMDocument;
use DOMNode;
use LogicException;
use ReflectionClass;
use ReflectionException;
use ReflectionProperty;
use Ups\NodeInterface;

abstract class NodeEntity implements NodeInterface
{
    private $constructorParameterNames = [];

    /**
     * {@inheritdoc}
     *
     * @throws ReflectionException
     */
    public function toNode(DOMDocument $document = null)
    {
        if (null === $document) {
            $document = new DOMDocument();
        }

        $class = new ReflectionClass(static::class);
        $node = $document->createElement($class->getShortName());

        foreach ($this->requiredProperties($class) as $property) {
            $this->appendElement($document, $node, $property);
            $this->constructorParameterNames[] = $property->getName();
        }

        foreach ($this->optionalProperties($class) as $property) {
            $this->appendElement($document, $node, $property);
        }

        return $node;
    }

    private function requiredProperties(ReflectionClass $class)
    {
        $parameters = [];
        $constructor = $class->getConstructor();

        if ($constructor) {
            $parameters = $constructor->getParameters();
        }

        foreach ($parameters as $parameter) {
            yield $class->getProperty($parameter->getName());
        }
    }

    /**
     * @param DOMDocument $document
     * @param DOMNode $node
     * @param ReflectionProperty $property
     */
    private function appendElement(DOMDocument $document, DOMNode $node, ReflectionProperty $property)
    {
        $accessor = $this->getAccessorName($property);
        $value = $this->$accessor();

        if ($value instanceof NodeInterface) {
            $node->appendChild($value->toNode($document));
        } else {
            if (is_bool($value)) {
                $value = $value ? 'Y' : 'N';
            }

            $node->appendChild($document->createElement(ucfirst($property->getName()), $value));
        }
    }

    /**
     * @param ReflectionProperty $property
     *
     * @return string
     */
    private function getAccessorName(ReflectionProperty $property)
    {
        $methodName = sprintf('get%s', ucfirst($property->getName()));

        if (! method_exists($this, $methodName)) {
            throw new LogicException(sprintf('Please implement method %s::%s()', static::class, $methodName));
        }

        return $methodName;
    }

    private function optionalProperties(ReflectionClass $class)
    {
        $defaultProperties = $class->getDefaultProperties();

        foreach ($class->getProperties() as $property) {
            $propertyName = $property->getName();

            if (in_array($propertyName, $this->constructorParameterNames)) {
                continue;
            }

            $accessor = $this->getAccessorName($property);
            $value = $this->$accessor();

            if ($value !== $defaultProperties[$propertyName]) {
                yield $property;
            }
        }
    }
}
