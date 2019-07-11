<?php

declare(strict_types=1);

namespace Somnambulist\Collection\Tests\Behaviours\Mutate;

use PHPUnit\Framework\TestCase;
use Somnambulist\Collection\MutableCollection as Collection;

/**
 * Class PadTest
 *
 * @package    Somnambulist\Collection\Tests\Behaviours\Mutate
 * @subpackage Somnambulist\Collection\Tests\Behaviours\Mutate\PadTest
 */
class PadTest extends TestCase
{

    /**
     * @group collection
     */
    public function testPad()
    {
        $col = new Collection();
        $col->pad(10, 'a');

        $this->assertCount(10, $col);
    }
}
