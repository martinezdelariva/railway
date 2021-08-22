<?php
/**
 *  (c) José Luis Martínez de la Riva <martinezdelariva@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE file
 *  that was distributed with this source code.
 */

declare(strict_types=1);

namespace Martinezdelariva\Railway\Test;

use function Martinezdelariva\Railway\tee;
use Martinezdelariva\Railway\Either\Right;
use PHPUnit\Framework\TestCase;

class TeeTest extends TestCase
{

    public function test_right_track()
    {
        $this->assertEquals(
            Right::of(1),
            tee(function() {})(Right::of(1))
        );
    }
}
