<?php
/**
 *  (c) José Luis Martínez de la Riva <martinezdelariva@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE file
 *  that was distributed with this source code.
 */

declare(strict_types=1);

namespace Martinezdelariva\Railway\Test;

use function Martinezdelariva\Railway\lift;
use Martinezdelariva\Railway\Either\Right;
use PHPUnit\Framework\TestCase;

class LiftTest extends TestCase
{
    /**
     * @var \Closure
     */
    private $increment;

    public function setUp()
    {
        $this->increment = function ($int) {
            return $int + 1;
        };
    }

    public function test_return_right()
    {
        $this->assertEquals(
            Right::of(2),
            lift($this->increment)(1)
        );
    }
}
