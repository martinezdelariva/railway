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
 * Combines switch functions in parallel.
 * 1-2 + 1-2 : 1-2
 */
class Plus
{
    public function __invoke(callable $addRight, callable $addLeft, callable $switch1, callable $switch2): callable
    {
        return function ($input) use ($addRight, $addLeft, $switch1, $switch2) {
            /** @var Either $either1 */
            /** @var Either $either2 */
            $either1 = $switch1($input);
            $either2 = $switch2($input);

            if ($either1->isRight() && $either2->isRight()) {
                return Right::of($addRight($either1->value(), $either2->value()));
            }

            if ($either1->isLeft() && $either2->isRight()) {
                return $either1;
            }

            if ($either1->isRight() && $either2->isLeft()) {
                return $either2;
            }

            if ($either1->isLeft() && $either2->isLeft()) {
                return Left::of($addLeft($either1->value(), $either2->value()));
            }

            // noop
        };
    }
}
