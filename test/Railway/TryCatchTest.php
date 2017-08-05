<?php
/**
 *  (c) José Luis Martínez de la Riva <martinezdelariva@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE file
 *  that was distributed with this source code.
 */

declare(strict_types=1);

namespace Martinezdelariv\Test\Railway;

use function Martinezdelariva\Railway\tryCatch;
use Martinezdelariva\Railway\Either\Left;
use Martinezdelariva\Railway\Either\Right;
use PHPUnit\Framework\TestCase;

class TryCatchTest extends TestCase
{
    /**
     * @var \Closure
     */
    private $increment;

    /**
     * @var \Closure
     */
    private $exception;

    public function setUp()
    {
        $this->increment = function ($int) {
            return $int + 1;
        };

        $this->exception = function (\Exception $exception) {
            throw $exception;
        };
    }

    public function test_right_track()
    {
        $this->assertEquals(
            Right::of(2),
            tryCatch($this->increment)(1)
        );
    }

    public function test_left_track()
    {
        $exception = new \Exception('Testing left track');

        $this->assertEquals(
            Left::of(new \Exception('Testing left track')),
            tryCatch($this->exception)($exception)
        );
    }
}
