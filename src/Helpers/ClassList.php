<?php

namespace Nethead\Markup\Helpers;

/**
 * Class ClassList
 * @package Nethead\Markup\Helpers
 */
class ClassList {
    /**
     * @var array
     */
    public $classList = [];

    /**
     * ClassList constructor.
     * @param array $classes
     */
    public function __construct(array $classes = [])
    {
        $this->classList = $classes;
    }

    /**
     * Add new class or classes
     * @param $class
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
     * Remove class
     * @param string $class
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
     * @param string $class
     * @return bool
     */
    public function contains(string $class): bool
    {
        return in_array($class, $this->classList);
    }

    /**
     * @param string $classToAdd
     * @param string $classToRemove
     * @return ClassList
     */
    public function replace(string $classToAdd, string $classToRemove): ClassList
    {
        $this->remove($classToRemove);
        $this->add($classToAdd);

        return $this;
    }

    /**
     * @param string $class
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
     * @return bool
     */
    public function empty(): bool
    {
        return empty($this->classList);
    }

    public function render(): string
    {
        return implode(' ', array_unique($this->classList, SORT_STRING));
    }

    /**
     * Implode the class list to a string without duplicates
     * @return string
     */
    public function __toString(): string
    {
        return $this->render();
    }
}