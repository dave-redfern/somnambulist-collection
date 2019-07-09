<?php

declare(strict_types=1);

namespace Somnambulist\Collection\Behaviours\Partition;

/**
 * Trait GroupBy
 *
 * @package    Somnambulist\Collection\Behaviours
 * @subpackage Somnambulist\Collection\Behaviours\Partition\GroupBy
 *
 * @property array $items
 */
trait GroupBy
{

    /**
     * Group the elements in the collection by the callable, returning a new collection
     *
     * The callable should return a valid key to group elements into. A valid key is
     * a string or integer or the current rules of PHP. Each group is a collection of
     * the values matched to it.
     *
     * @param callable $criteria
     *
     * @return static
     */
    public function groupBy(callable $criteria)
    {
        $groups = [];

        foreach ($this->items as $key => $value) {
            $group = $criteria($value, $key);

            if (!isset($groups[$group])) {
                $groups[$group] = [];
            }

            $groups[$group][] = $value;
        }

        foreach ($groups as $group => $values) {
            $groups[$group] = $this->new($values);
        }

        return $this->new($groups);
    }
}