<?php
/**
 *  (c) José Luis Martínez de la Riva <martinezdelariva@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE file
 *  that was distributed with this source code.
 */

declare(strict_types=1);

namespace Martinezdelariva\Railway\Test;

use function Martinezdelariva\Railway\doubleMap;
use Martinezdelariva\Railway\Either\Left;
use Martinezdelariva\Railway\Either\Right;
use PHPUnit\Framework\TestCase;

class DoubleMapTest extends TestCase
{
    /**
     * @var \Closure
     */
    private $increment;

    /**
     * @var \Closure
     */
    private $decrement;

    public function setUp()
    {
        $this->increment = function ($int) {
            return $int + 1;
        };

        $this->decrement = function ($int) {
            return $int - 1;
        };
    }

    public function test_right_track()
    {
        $this->assertEquals(
            Right::of(2),
            doubleMap($this->increment, $this->decrement)(Right::of(1))
        );
    }

    public function test_left_track()
    {
        $this->assertEquals(
            Left::of(0),
            doubleMap($this->increment, $this->decrement)(Left::of(1))
        );
    }
}
