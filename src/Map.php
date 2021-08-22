<?php
/**
 *  (c) José Luis Martínez de la Riva <martinezdelariva@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE file
 *  that was distributed with this source code.
 */

declare(strict_types=1);

namespace Martinezdelariva\Railway;

use Martinezdelariva\Railway\Either\Either;
use Martinezdelariva\Railway\Either\Right;

/**
 * Converts one track function into two track function.
 * 1-1 : 2-2
 */
class Map
{
    public function __invoke(callable $oneTrack): callable
    {
        return function (Either $either) use ($oneTrack) {
            if ($either->isRight()) {
                return Right::of($oneTrack($either->value()));
            }

            return $either;
        };
    }
}
