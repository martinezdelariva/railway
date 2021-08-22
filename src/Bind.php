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
 * Converts switch into two track function
 * 1-2 : 2-2
 */
class Bind
{
    public function __invoke($switch): callable
    {
        return function (Either $either) use ($switch) {
            if ($either->isRight()) {
                return $switch($either->value());
            }

            return $either;
        };
    }
}
