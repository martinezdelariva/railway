<?php
/**
 *  (c) José Luis Martínez de la Riva <martinezdelariva@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE file
 *  that was distributed with this source code.
 */

declare(strict_types=1);

namespace Martinezdelariva\Railway;

use Martinezdelariva\Railway\Either\Right;

/**
 * On track 1-1 to switch 1-2.
 */
class Lift
{
    public function __invoke(callable $oneTrack)
    {
        return function ($input) use ($oneTrack) {
            return Right::of($oneTrack($input));
        };
    }
}
