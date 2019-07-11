<?php

declare(strict_types=1);

namespace Somnambulist\Collection;

use ArrayIterator;
use Somnambulist\Collection\Contracts\Collection;
use Somnambulist\Collection\Utils\ClassUtils;
use function array_key_exists;
use function count;
use function is_array;
use function is_null;

/**
 * Class AbstractCollection
 *
 * @package    Somnambulist\Collection
 * @subpackage Somnambulist\Collection\AbstractCollection
 */
abstract class AbstractCollection implements Collection
{

    /**
     * Should array values on access be wrapped in a Collection
     *
     * This will replace the array value in the Collection with the Collection instance.
     * The default is to do this as it allows for consistent object access down large
     * array structures, but as it can be a matter of preference, it can be disabled.
     * If disabled, note this is a global flag for all Collection instances to ensure
     * consistent behaviour.
     *
     * @var bool
     */
    private static $wrapArrays = true;

    /**
     * The type of collection to create when new collections are needed
     *
     * Must be a Collection interface class. This is required for the Set, where operations
     * can result in duplicate values and that is the expected behaviour, but allowing a
     * different type of collection is useful e.g.: return a limited set after filtering.
     *
     * @var string
     */
    protected static $collectionClass;

    /**
     * @var array
     */
    protected $items = [];

    /**
     * @param mixed $items
     *
     * @return static
     */
    public static function collect($items = [])
    {
        return new static($items);
    }

    /**
     * @param mixed $items
     *
     * @return static
     */
    public static function create($items = [])
    {
        return new static($items);
    }

    public static function getCollectionClass(): string
    {
        return static::$collectionClass;
    }

    public static function setCollectionClass(string $class): void
    {
        ClassUtils::assertClassImplements($class, Collection::class);

        static::$collectionClass = $class;
    }

    public static function disableArrayWrapping(): void
    {
        self::$wrapArrays = false;
    }

    public static function enableArrayWrapping(): void
    {
        self::$wrapArrays = true;
    }

    public static function isArrayWrappingEnabled(): bool
    {
        return self::$wrapArrays;
    }

    /**
     * @param string $name
     *
     * @return mixed|static
     */
    public function __get($name)
    {
        return $this->offsetGet($name);
    }

    public function __isset($name)
    {
        return $this->offsetExists($name);
    }

    public static function __set_state($array)
    {
        $object        = new static();
        $object->items = $array['items'];

        return $object;
    }

    /**
     * @return int
     */
    public function count()
    {
        return count($this->items);
    }

    public function getIterator()
    {
        return new ArrayIterator($this->items);
    }

    /**
     * Creates a new instance using the defined {@see AbstractCollection::$collectionClass}
     *
     * This is used internally when creating new Collections from operations to avoid
     * instances where a transformation would create duplicate values and otherwise
     * fail to work with the Set logic.
     *
     * @param array|mixed $items
     *
     * @return static|Collection
     */
    public function new($items)
    {
        if (is_null(static::$collectionClass)) {
            static::$collectionClass = static::class;
        }

        return new static::$collectionClass($items);
    }

    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->items);
    }

    public function offsetGet($offset)
    {
        $value = $this->items[$offset];

        if (self::$wrapArrays && is_array($value)) {
            $value = $this->items[$offset] = $this->new($value);
        }

        return $value;
    }
}
