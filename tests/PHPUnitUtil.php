<?php

namespace Tests;

use ReflectionClass;

/**
 * Used to invoke protected or private methods.
 * Class PHPUnitUtil
 */
class PHPUnitUtil
{
    public static function callMethod($obj, $name, array $args)
    {
        $class = new ReflectionClass($obj);
        $method = $class->getMethod($name);
        $method->setAccessible(true);

        return $method->invokeArgs($obj, $args);
    }

    public static function setProperty($obj, $name, $value)
    {
        $class = new ReflectionClass($obj);
        $property = $class->getProperty($name);
        $property->setAccessible(true);

        return $property->setValue($obj, $value);
    }

    public static function getProperty($obj, $name)
    {
        $class = new ReflectionClass($obj);
        $property = $class->getProperty($name);
        $property->setAccessible(true);

        return $property->getValue($obj);
    }
}
