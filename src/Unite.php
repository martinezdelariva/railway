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

/**
 * Join two switches into another switch
 * 1-2 and 1-2 : 1-2
 */
class Unite
{
    public function __invoke(callable $switch1, callable $switch2): callable
    {
        return function ($input) use ($switch1, $switch2) {
            /** @var Either $either */
            $either = $switch1($input);
            if ($either->isRight()) {
                return $switch2($either->value());
            }

            return $either;
        };
    }
}
