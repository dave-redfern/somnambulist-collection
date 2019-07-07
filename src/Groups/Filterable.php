<?php

declare(strict_types=1);

namespace Somnambulist\Collection\Groups;

use Somnambulist\Collection\Behaviours\CanFilter;
use Somnambulist\Collection\Behaviours\CanFilterKeys;

/**
 * Trait Filterable
 *
 * @package    Somnambulist\Collection\Groups
 * @subpackage Somnambulist\Collection\Groups\Filterable
 */
trait Filterable
{

    use CanFilter;
    use CanFilterKeys;

}