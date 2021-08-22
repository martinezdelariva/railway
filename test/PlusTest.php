<?php
/**
 *  (c) José Luis Martínez de la Riva <martinezdelariva@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE file
 *  that was distributed with this source code.
 */

declare(strict_types=1);

namespace Martinezdelariva\Railway\Test;

use function Martinezdelariva\Railway\plus;
use Martinezdelariva\Railway\Either\Left;
use Martinezdelariva\Railway\Either\Right;
use PHPUnit\Framework\TestCase;

class PlusTest extends TestCase
{
    /** @var  \Closure */
    private $addRight;

    /** @var  \Closure */
    private $addLeft;

    /** @var  \Closure */
    private $increment1;

    /** @var  \Closure */
    private $increment2;

    /** @var  \Closure */
    private $exception1;

    /** @var  \Closure */
    private $exception2;

    public function setUp()
    {
        $this->addRight = function (int $one, int $other) {
            return [$one, $other];
        };

        $this->addLeft = function (\Exception $one, \Exception $other) {
            return new \Exception($one->getMessage() . " and " . $other->getMessage());
        };

        $this->increment1 = function (int $int) {
            return Right::of($int + 1);
        };

        $this->increment2 = function (int $int) {
            return Right::of($int + 2);
        };

        $this->exception1 = function () {
            return Left::of(new \Exception('first'));
        };

        $this->exception2 = function () {
            return Left::of(new \Exception('second'));
        };
    }

    public function test_both_right()
    {
        $this->assertEquals(
            Right::of([2, 3]),
            plus($this->addRight, $this->addLeft, $this->increment1, $this->increment2)(1)
        );
    }

    public function test_first_left()
    {
        $this->assertEquals(
            Left::of(new \Exception('first')),
            plus($this->addRight, $this->addLeft, $this->exception1, $this->increment2)(1)
        );
    }

    public function test_second_left()
    {
        $this->assertEquals(
            Left::of(new \Exception('second')),
            plus($this->addRight, $this->addLeft, $this->increment1, $this->exception2)(1)
        );
    }

    public function test_both_left()
    {
        $this->assertEquals(
            Left::of(new \Exception('first and second')),
            plus($this->addRight, $this->addLeft, $this->exception1, $this->exception2)(1)
        );
    }
}
