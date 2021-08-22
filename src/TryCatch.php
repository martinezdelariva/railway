<?php
/**
 *  (c) José Luis Martínez de la Riva <martinezdelariva@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE file
 *  that was distributed with this source code.
 */

declare(strict_types=1);

namespace Martinezdelariva\Railway;

use Martinezdelariva\Railway\Either\Left;
use Martinezdelariva\Railway\Either\Right;
use Throwable;

/**
 * Handling exceptions. Convert one track into switch.
 * 1-1 : 1-2
 */
class TryCatch
{
    public function __invoke(callable $oneTrack)
    {
        return function ($input) use ($oneTrack) {
            try {
                return Right::of($oneTrack($input));
            } catch (Throwable $throwable) {
                return Left::of($throwable);
            }
        };
    }
}
