<?php

declare(strict_types=1);

namespace Somnambulist\Collection\Behaviours;

use function mb_convert_case;
use function mb_strtolower;
use function mb_strtoupper;
use function ucwords;
use function strtolower;
use function strtoupper;

/**
 * Trait StringManipulations
 *
 * @package    Somnambulist\Collection\Behaviours
 * @subpackage Somnambulist\Collection\Behaviours\StringManipulations
 *
 * @property array $items
 */
trait StringManipulations
{

    /**
     * Returns a new collection will all string values capitalized
     *
     * @return static
     */
    public function capitalize(): self
    {
        return $this->map(function ($item) {
            return (function_exists('mb_convert_case')) ? mb_convert_case($item, MB_CASE_TITLE) : ucwords($item);
        });
    }

    /**
     * Returns a new collection will all values mapped to lower case
     *
     * @return static
     */
    public function lower(): self
    {
        return $this->map(function ($item) {
            return (function_exists('mb_strtolower')) ? mb_strtolower($item) : strtolower($item);
        });
    }

    /**
     * Returns a new collection will all values mapped to UPPER case
     *
     * @return static
     */
    public function upper(): self
    {
        return $this->map(function ($item) {
            return (function_exists('mb_strtoupper')) ? mb_strtoupper($item) : strtoupper($item);
        });
    }
}