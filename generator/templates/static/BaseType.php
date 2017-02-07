<?php

namespace Spatie\SchemaOrg;

use ReflectionClass;
use Spatie\SchemaOrg\Exceptions\InvalidProperty;

abstract class BaseType implements Type
{
    /** @var array */
    protected $properties = [];

    /**
     * @return string
     */
    public function getContext(): string
    {
        return 'http://schema.org';
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return (new ReflectionClass($this))->getShortName();
    }

    /**
     * @param string $property
     * @param $value
     *
     * @return $this
     */
    public function setProperty(string $property, $value)
    {
        $this->properties[$property] = $value;

        return $this;
    }

    /**
     * @param bool $condition
     * @param callable $callback
     *
     * @return $this
     */
    public function if($condition, callable $callback)
    {
        if ($condition) {
            $callback($this);
        }

        return $this;
    }

    /**
     * @param string $property
     * @param null $default
     *
     * @return mixed|null
     */
    public function getProperty(string $property, $default = null)
    {
        return $this->properties[$property] ?? $default;
    }

    /**
     * @return array
     */
    public function getProperties(): array
    {
        return $this->properties;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray(): array
    {
        $properties = $this->serializeProperty($this->getProperties());

        return [
            '@context' => $this->getContext(),
            '@type' => $this->getType(),
        ] + $properties;
    }

    /**
     * @param $property
     *
     * @return array
     * @throws \Spatie\SchemaOrg\Exceptions\InvalidProperty
     */
    protected function serializeProperty($property)
    {
        if (is_array($property)) {
            return array_map([$this, 'serializeProperty'], $property);
        }

        if ($property instanceof Type) {
            $property = $property->toArray();
            unset($property['@context']);
        }

        if (is_object($property)) {
            throw new InvalidProperty();
        }

        return $property;
    }

    /**
     * {@inheritdoc}
     */
    public function toScript(): string
    {
        return '<script type="application/ld+json">'.json_encode($this->toArray()).'</script>';
    }

    /**
     * {@inheritdoc}
     */
    public function __toString(): string
    {
        return $this->toScript();
    }
}
