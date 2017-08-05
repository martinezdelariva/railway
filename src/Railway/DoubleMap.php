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
use Martinezdelariva\Railway\Either\Left;
use Martinezdelariva\Railway\Either\Right;

/**
 * Handles both tracks, converting one track into two track function.
 * 1-1 : 2-2
 */
class DoubleMap
{
    public function __invoke(callable $oneTrackRight, callable $oneTrackLeft) {
        return function (Either $either) use ($oneTrackRight, $oneTrackLeft) {
            if ($either->isRight()) {
                return Right::of($oneTrackRight($either->value()));
            }

            return Left::of($oneTrackLeft($either->value()));
        };
    }
}
