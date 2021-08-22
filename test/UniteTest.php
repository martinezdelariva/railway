<?php
/**
 *  (c) José Luis Martínez de la Riva <martinezdelariva@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE file
 *  that was distributed with this source code.
 */

declare(strict_types=1);

namespace Martinezdelariva\Railway\Test;

use function Martinezdelariva\Railway\unite;
use Martinezdelariva\Railway\Either\Left;
use Martinezdelariva\Railway\Either\Right;
use PHPUnit\Framework\TestCase;

class UniteTest extends TestCase
{
    /**
     * @var \Closure
     */
    private $increment1;

    /**
     * @var \Closure
     */
    private $increment2;

    /**
     * @var \Closure
     */
    private $failure;

    public function setUp()
    {
        $this->increment1 = function ($int) {
            return Right::of($int + 1);
        };

        $this->increment2 = function ($int) {
            return Right::of($int + 2);
        };

        $this->failure = function () {
            return Left::of('error');
        };
    }

    public function test_right_track()
    {
        $this->assertEquals(
            Right::of(4),
            unite($this->increment1, $this->increment2)(1)
        );
    }

    public function test_left_track()
    {
        $this->assertEquals(
            Left::of('error'),
            unite($this->failure, $this->increment2)(1)
        );
        $this->assertEquals(
            Left::of('error'),
            unite($this->increment2, $this->failure)(1)
        );
    }
}
