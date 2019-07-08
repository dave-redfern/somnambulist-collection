<?php

declare(strict_types=1);

namespace Somnambulist\Collection;

use Somnambulist\Collection\Behaviours\CannotAddDuplicateItems;
use Somnambulist\Collection\Behaviours\Freezeable;
use Somnambulist\Collection\Contracts\Assertable as IsAssertable;
use Somnambulist\Collection\Contracts\Comparable as IsDiffable;
use Somnambulist\Collection\Contracts\Filterable as IsFilterable;
use Somnambulist\Collection\Contracts\Freezable as IsFreezable;
use Somnambulist\Collection\Contracts\Mappable as IsMappable;
use Somnambulist\Collection\Contracts\Mutable as IsMutable;
use Somnambulist\Collection\Contracts\Runnable as IsRunnable;
use Somnambulist\Collection\Contracts\Serializable as IsSerializable;
use Somnambulist\Collection\Contracts\Sortable as IsSortable;
use Somnambulist\Collection\Groups\Aggregates;
use Somnambulist\Collection\Groups\Assertable;
use Somnambulist\Collection\Groups\Comparable;
use Somnambulist\Collection\Groups\Exportable;
use Somnambulist\Collection\Groups\Filterable;
use Somnambulist\Collection\Groups\Mappable;
use Somnambulist\Collection\Groups\MutableSet as Mutable;
use Somnambulist\Collection\Groups\Partitionable;
use Somnambulist\Collection\Groups\Queryable;
use Somnambulist\Collection\Groups\Runnable;
use Somnambulist\Collection\Utils\RunProxy;
use Somnambulist\Collection\Utils\Value;

/**
 * Class MutableSet
 *
 * Note: this is not a true set, in that string keys are allowed.
 *
 * A set only contains the value once. This implementation attempts to keep
 * duplicate values out and will raise an exception if a duplicate is found
 * during any mutation operation.
 *
 * Certain mutations cannot be used in a Set, e.g. pad, fill, fillKeys as they
 * generate the same value for every key.
 *
 * @package    Somnambulist\Collection
 * @subpackage Somnambulist\Collection\MutableSet
 */
class MutableSet extends AbstractCollection implements IsAssertable, IsMutable, IsFilterable, IsMappable, IsDiffable, IsFreezable, IsSerializable, IsSortable
{

    use CannotAddDuplicateItems;
    use Assertable;
    use Aggregates;
    use Comparable;
    use Exportable;
    use Filterable;
    use Freezeable;
    use Mappable;
    use Mutable;
    use Partitionable;
    use Queryable;
    use Runnable;

    protected static $collectionClass = MutableCollection::class;

    /**
     * Constructor.
     *
     * @param array $items
     */
    public function __construct($items = [])
    {
        foreach (Value::toArray($items) as $key => $value) {
            $this->set($key, $value);
        }
    }

    /**
     * @param string $name
     *
     * @return mixed|static
     */
    public function __get($name)
    {
        if ('run' === $name && $this instanceof IsRunnable) {
            return new RunProxy($this);
        }

        return $this->offsetGet($name);
    }
}