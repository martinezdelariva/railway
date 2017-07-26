<?php
/**
 *  (c) José Luis Martínez de la Riva <martinezdelariva@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE file
 *  that was distributed with this source code.
 */

declare(strict_types=1);

namespace Martinezdelariv\Test\Railway;

use function Martinezdelariva\Railway\bind;
use Martinezdelariva\Railway\Either\Right;
use Martinezdelariva\Railway\Either\Left;
use PHPUnit\Framework\TestCase;

class BindTest extends TestCase
{
    /**
     * @var \Closure
     */
    private $increment;

    public function setUp()
    {
        $this->increment = function ($int) {
            return Right::of($int + 1);
        };
    }

    public function test_right_track()
    {
        $this->assertEquals(
            Right::of(2),
            bind($this->increment)(Right::of(1))
        );
    }

    public function test_left_track()
    {
        $this->assertEquals(
            Left::of('error'),
            bind($this->increment)(Left::of('error'))
        );
    }
}
