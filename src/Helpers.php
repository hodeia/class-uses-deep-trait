<?php

namespace Hodeia\Classusestrait;

/**
 * This class provides helper methods for working with traits.
 *
 * @package Hodeia\Classusestrait
 * @author Oier Beaskoetxea <oier@hodeia.digital>
 */
class Helpers
{
    /**
     * Recursively retrieves all traits used by a class, including those used by its parent classes and traits.
     *
     * @param string $class The name of the class to retrieve the traits for.
     * @param bool $autoload Whether or not to autoload the class if it hasn't been loaded yet. Default is true.
     * @return string[] An array of trait names used by the class, including those used by its parent classes
     * and traits.
     */
    public static function classUsesDeep(string $class, bool $autoload = true): array
    {
        // Get the traits used by the class
        $traits = class_uses($class, $autoload);

        // Get the traits used by the parent class, if any
        if ($parent = get_parent_class($class)) {
            $traits = array_merge($traits, static::classUsesDeep($parent, $autoload));
        }

        // Get the traits used by the traits used by the class
        foreach ($traits as $trait) {
            $traits = array_merge($traits, static::classUsesDeep($trait, $autoload));
        }

        return array_values(array_unique($traits));
    }

    /**
     * Checks if a class or its parent classes and traits contain a specified trait.
     *
     * @param string $class The name of the class to check for the trait.
     * @param string $trait The name of the trait to check for.
     * @param bool $autoload Whether or not to autoload the class if it hasn't been loaded yet. Default is true.
     * @return bool Returns true if the class or its parent classes and traits contain the specified trait,
     * false otherwise.
     */
    public static function classContainsTrait(string $class, string $trait, bool $autoload = true): bool
    {
        return in_array($trait, static::classUsesDeep($class, $autoload));
    }
}
