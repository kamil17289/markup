<?php

namespace Nethead\Markup\Tags;

use Nethead\Markup\Foundation\Tag;
use Nethead\Markup\Helpers\BindableToForm;
use Nethead\Markup\Helpers\CanHaveMinMaxValues;

/**
 * Creates a "meter" element.
 *
 * @package Nethead\Markup\Tags
 */
class Meter extends Tag {
    use CanHaveMinMaxValues,
    BindableToForm;

    /**
     * Meter constructor.
     *
     * @param string $id
     *  HTML ID for the meter (it is like input, can be bind with label
     * @param string $labelText
     *  Meter label text
     * @param $value
     *  Current meter value
     * @param int $max
     *  Maximum meter value, considered being 100%
     * @param int $min
     *  Minimum meter value, considered being 0%
     * @param array $attributes
     *  Additional HTML attributes you want to add
     */
    public function __construct(string $id, string $labelText, $value, $max = 100, $min = 0, array $attributes = [])
    {
        parent::__construct('meter', $attributes, [$labelText]);

        $this->attrs()->setMany([
            'id' => $id,
            'min' => $min,
            'max' => $max,
            'value' => $value
        ]);
    }

    /**
     * Static factory method.
     *
     * @see Meter::__construct
     * @param string $id
     * @param string $labelText
     * @param int $max
     * @param int $min
     * @param array $attributes
     * @return Meter
     */
    public static function make(string $id, string $labelText, $max = 100, $min = 0, array $attributes = []): Meter
    {
        return new self($id, $labelText, $max, $min, $attributes);
    }

    /**
     * Set the thresholds values for the meter.
     * Color of the meter will change when its value reaches the thresholds.
     *
     * @param string $type
     *  Threshold name, can be 'high'|'low'|'optimum' to describe the value range.
     *  You can also use shorthands like 'h'|'l'|'o'
     * @param mixed $value
     *  Value for the threshold
     * @return $this
     */
    public function threshold(string $type, $value): Meter
    {
        $attrs = $this->attrs();

        switch($type) {
            case 'high':
            case 'h':
                $attrs->set('high', $value);
                break;

            case 'low':
            case 'l':
                $attrs->set('low', $value);
                break;

            case 'optimum':
            case 'o':
                $attrs->set('optimum', $value);
                break;
        }

        return $this;
    }
}