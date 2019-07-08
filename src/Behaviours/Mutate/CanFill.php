<?php

declare(strict_types=1);

namespace Somnambulist\Collection\Behaviours\Mutate;

use function array_fill;
use function array_fill_keys;

/**
 * Trait CanFill
 *
 * @package    Somnambulist\Collection\Behaviours
 * @subpackage Somnambulist\Collection\Behaviours\Mutate\CanFill
 *
 * @property array $items
 */
trait CanFill
{

    /**
     * Fill an array with values beginning at index defined by start for count members
     *
     * Start can be a negative number. Count can be zero or more.
     *
     * @link https://www.php.net/array_fill
     *
     * @param int   $start
     * @param int   $count
     * @param mixed $value
     *
     * @return static
     */
    public function fill($start, $count, $value)
    {
        return $this->new(array_fill($start, $count, $value));
    }

    /**
     * For all values in the current Collection, use as a key and assign $value to them
     *
     * This should only be used with scalar values that can be used as array keys.
     * A new Collection is returned with all previous values as keys, assigned the value.
     *
     * @link https://www.php.net/array_fill_keys
     *
     * @param mixed $value
     *
     * @return static
     */
    public function fillKeysWith($value)
    {
        return $this->new(array_fill_keys($this->values()->toArray(), $value));
    }
}
