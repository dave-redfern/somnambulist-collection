<?php

namespace Somnambulist\Collection\Tests\Behaviours\Mutate;

use PHPUnit\Framework\TestCase;
use Somnambulist\Collection\MutableCollection as Collection;
use Somnambulist\Collection\Tests\Fixtures\TestClass4;

/**
 * Class UnionTest
 *
 * @package    Somnambulist\Collection\Tests\Behaviours\Mutate
 * @subpackage Somnambulist\Collection\Tests\Behaviours\Mutate\UnionTest
 */
class UnionTest extends TestCase
{

    /**
     * @group union
     */
    public function testUnion()
    {
        $col = new Collection(new TestClass4());
        $col2 = ['bar' => 'too'];

        $this->assertCount(1, $col);
        $col->union($col2);

        $this->assertCount(2, $col);
        $this->assertTrue($col->has('bar'));
    }

    /**
     * @group union
     */
    public function testUnionCollection()
    {
        $col = new Collection(['foo' => 'bar']);
        $col2 = new Collection(['bar' => 'too']);

        $this->assertCount(1, $col);
        $col->union($col2);
        $this->assertCount(2, $col);
        $this->assertTrue($col->has('bar'));
    }

    /**
     * @group union
     */
    public function testUnionArrayObject()
    {
        $col = new Collection(new TestClass4());
        $col2 = new \ArrayObject(['bar' => 'too']);

        $this->assertCount(1, $col);
        $col->union($col2);
        $this->assertCount(2, $col);
        $this->assertTrue($col->has('bar'));
    }

    /**
     * @group union
     */
    public function testUnionNonArray()
    {
        $col = new Collection([new TestClass4()]);
        $col2 = 'bar';

        $this->assertCount(1, $col);

        $col->union($col2);

        $this->assertCount(1, $col);
    }

    /**
     * @group union
     */
    public function testUnionWithSameKeyKeepsFirstValue()
    {
        $col = new Collection($t = new TestClass4());
        $col2 = 'bar';

        $this->assertCount(1, $col);

        $col->union($col2);

        $this->assertCount(1, $col);

        $this->assertSame($t, $col->first());
    }
}