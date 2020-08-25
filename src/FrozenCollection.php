<?php

declare(strict_types=1);

namespace Somnambulist\Collection;

use JsonSerializable;
use Somnambulist\Collection\Behaviours\CannotAddOrRemoveItems;
use Somnambulist\Collection\Behaviours\Proxyable;
use Somnambulist\Collection\Contracts\CanAggregateItems;
use Somnambulist\Collection\Contracts\Comparable as IsComparable;
use Somnambulist\Collection\Contracts\Filterable as IsFilterable;
use Somnambulist\Collection\Contracts\Immutable as IsImmutable;
use Somnambulist\Collection\Contracts\Mappable as IsMappable;
use Somnambulist\Collection\Contracts\Runnable as IsRunnable;
use Somnambulist\Collection\Contracts\Serializable as IsSerializable;
use Somnambulist\Collection\Contracts\Sortable as IsSortable;
use Somnambulist\Collection\Groups\Aggregates;
use Somnambulist\Collection\Groups\Assertable;
use Somnambulist\Collection\Groups\Comparable;
use Somnambulist\Collection\Groups\Exportable;
use Somnambulist\Collection\Groups\Filterable;
use Somnambulist\Collection\Groups\ImmutableQueryable;
use Somnambulist\Collection\Groups\Mappable;
use Somnambulist\Collection\Groups\Runnable;
use Somnambulist\Collection\Groups\Sortable;
use Somnambulist\Collection\Utils\MapProxy;
use Somnambulist\Collection\Utils\RunProxy;
use Somnambulist\Collection\Utils\Value;

/**
 * Class FrozenCollection
 *
 * @package    Somnambulist\Collection
 * @subpackage Somnambulist\Collection\FrozenCollection
 *
 * @property-read MapProxy $map
 * @property-read RunProxy $run
 */
class FrozenCollection extends AbstractCollection implements
    CanAggregateItems,
    IsComparable,
    IsFilterable,
    IsImmutable,
    IsMappable,
    IsRunnable,
    IsSerializable,
    IsSortable,
    JsonSerializable
{

    use CannotAddOrRemoveItems;
    use Aggregates;
    use Assertable;
    use Comparable;
    use Exportable;
    use Filterable;
    use ImmutableQueryable;
    use Mappable;
    use Runnable;
    use Proxyable;
    use Sortable;

    public function __construct($items = [])
    {
        $this->items = Value::toArray($items);
    }
}
