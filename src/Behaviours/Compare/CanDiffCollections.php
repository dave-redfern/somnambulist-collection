<?php

declare(strict_types=1);

namespace Somnambulist\Collection\Behaviours\Compare;

use Somnambulist\Collection\Utils\Value;
use function array_diff;
use function array_diff_assoc;
use function array_diff_key;
use function array_diff_uassoc;
use function array_diff_ukey;
use function array_udiff;

/**
 * Trait CanDiffCollections
 *
 * @package    Somnambulist\Collection\Behaviours
 * @subpackage Somnambulist\Collection\Behaviours\Compare\CanDiffCollections
 *
 * @property array $items
 */
trait CanDiffCollections
{

    /**
     * Get the items in the collection that are not present in the given items.
     *
     * @param mixed $items
     *
     * @return static
     */
    public function diff($items)
    {
        return $this->new(array_diff($this->items, Value::toArray($items)));
    }

    /**
     * Get the items in the collection that are not present in the given items.
     *
     * @param mixed    $items
     * @param callable $callback
     *
     * @return static
     */
    public function diffUsing($items, callable $callback)
    {
        return $this->new(array_udiff($this->items, Value::toArray($items), $callback));
    }

    /**
     * Get the items in the collection whose keys and values are not present in the given items.
     *
     * @param mixed $items
     *
     * @return static
     */
    public function diffAssoc($items)
    {
        return $this->new(array_diff_assoc($this->items, Value::toArray($items)));
    }

    /**
     * Get the items in the collection whose keys and values are not present in the given items.
     *
     * @param mixed    $items
     * @param callable $callback
     *
     * @return static
     */
    public function diffAssocUsing($items, callable $callback)
    {
        return $this->new(array_diff_uassoc($this->items, Value::toArray($items), $callback));
    }

    /**
     * Get the items in the collection whose keys are not present in the given items.
     *
     * @param mixed $items
     *
     * @return static
     */
    public function diffKeys($items)
    {
        return $this->new(array_diff_key($this->items, Value::toArray($items)));
    }

    /**
     * Get the items in the collection whose keys are not present in the given items.
     *
     * @param mixed    $items
     * @param callable $callback
     *
     * @return static
     */
    public function diffKeysUsing($items, callable $callback)
    {
        return $this->new(array_diff_ukey($this->items, Value::toArray($items), $callback));
    }
}