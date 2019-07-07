<?php

declare(strict_types=1);

namespace Somnambulist\Collection\Behaviours;

/**
 * Trait Clearable
 *
 * @package    Somnambulist\Collection\Behaviours
 * @subpackage Somnambulist\Collection\Behaviours\Clearable
 *
 * @property array $items
 */
trait Clearable
{

    /**
     * Clear all elements from the collection
     *
     * @return static
     */
    public function clear(): self
    {
        $this->items = [];

        return $this;
    }

    /**
     * Alias of clear
     *
     * @return static
     */
    public function reset(): self
    {
        return $this->clear();
    }
}