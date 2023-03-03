<?php

namespace Hodeia\Classusestrait\Traits;

use Hodeia\Classusestrait\Helpers;

/**
 * Trait ClassUsesTrait
 *
 * This trait provides helper methods for working with traits.
 *
 * @author Oier Beaskoetxea <oier@hodeia.digital>
 * @package Hodeia\Classusestrait\Traits
 */
trait ClassUsesTrait
{
    /**
     * Recursively retrieves all traits used by the class that uses this trait, including those used by its parent
     * classes and traits.
     *
     * @param bool $autoload Whether or not to autoload the class if it hasn't been loaded yet. Default is true.
     * @return array An array of trait names used by the class, including those used by its parent classes and traits.
     */
    public function classUsesDeep(bool $autoload = true): array
    {
        // Get the name of the class that uses this trait
        $class = static::class;

        // Call the classUsesDeep method of the Helpers class to get the traits used by the class
        return Helpers::classUsesDeep($class, $autoload);
    }

    /**
     * Checks if the class that uses this trait contains a specified trait.
     *
     * @param string $trait The name of the trait to check for.
     * @param bool $autoload Whether or not to autoload the class if it hasn't been loaded yet. Default is true.
     * @return bool Returns true if the class contains the specified trait, false otherwise.
     */
    public function classContainsTrait(string $trait, bool $autoload = true): bool
    {
        // Get the name of the class that uses this trait
        $class = static::class;

        // Call the classContainsTrait method of the Helpers class to check if the class contains the specified trait
        return Helpers::classContainsTrait($class, $trait, $autoload);
    }
}
