<?php

namespace Hodeia\Classusestrait;

/**
 * A class that provides helper methods for working with traits.
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
     * @return array An array of trait names used by the class, including those used by its parent classes and traits.
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

        return $traits;
    }
}
