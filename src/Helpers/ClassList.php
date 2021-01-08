<?php

namespace Nethead\Markup\Helpers;

/**
 * Helper for CSS class manipulation.
 *
 * @package Nethead\Markup\Helpers
 */
class ClassList {
    /**
     * @var array The list of CSS classes
     */
    public $classList = [];

    /**
     * ClassList constructor.
     *
     * @param array $classes
     *  Class list in form of numeric array. Only values are considered, keys are irrelevant.
     */
    public function __construct(array $classes = [])
    {
        $this->classList = $classes;
    }

    /**
     * Add new class or classes
     *
     * @param mixed $class
     *  If string is provided, it will be split with spaces and each chunk will be used as a CSS class.
     *  If it's array, all it's values will be added at the end.
     *  Make sure each array value holds one CSS class.
     * @return ClassList
     */
    public function add($class): ClassList
    {
        if (is_string($class)) {
            $class = explode(' ', $class);
        }

        array_push($this->classList, ...$class);

        return $this;
    }

    /**
     * Remove class name from the list.
     *
     * @param string $class The class name you want to remove
     * @return ClassList
     */
    public function remove(string $class): ClassList
    {
        $keys = array_keys($this->classList, $class);

        foreach($keys as $key) {
            unset($this->classList[$key]);
        }

        return $this;
    }

    /**
     * Check if the class name was added to this list.
     * @param string $class Class name you want to check
     * @return bool TRUE if the class name was added, FALSE otherwise
     */
    public function contains(string $class): bool
    {
        return in_array($class, $this->classList);
    }

    /**
     * Remove a class and add another.
     * New class name will be added no matter if it already exists or not, and the one to remove exists.
     * @param string $classToAdd Class name to add, not validated for duplication
     * @param string $classToRemove Class name to remove, if it doesn't exist no error is triggered
     * @return ClassList
     */
    public function replace(string $classToAdd, string $classToRemove): ClassList
    {
        $this->remove($classToRemove);
        $this->add($classToAdd);

        return $this;
    }

    /**
     * Toggle class name in the list.
     * If the provided class name exists in the list it will be removed. It will be added otherwise.
     * @param string $class Class name to toggle
     * @return ClassList
     */
    public function toggle(string $class): ClassList
    {
        if ($this->contains($class)) {
            $this->remove($class);
        }
        else {
            $this->add($class);
        }

        return $this;
    }

    /**
     * Check if the list contains any class names
     * @return bool TRUE if no class names are added, FALSE otherwise
     */
    public function empty(): bool
    {
        return empty($this->classList);
    }

    /**
     * Implode the class list to a string.
     * Render class names into space separated string that can be used as HTML attribute value.
     * Checks for duplicates and only renders each class one time.
     * @return string
     */
    public function render(): string
    {
        return implode(' ', array_unique($this->classList, SORT_STRING));
    }

    /**
     * Convert the ClasList object to a string.
     * @see ClassList::render()
     * @return string
     */
    public function __toString(): string
    {
        return $this->render();
    }
}