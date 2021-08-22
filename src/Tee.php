<?php
/**
 *  (c) José Luis Martínez de la Riva <martinezdelariva@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE file
 *  that was distributed with this source code.
 */

declare(strict_types=1);

namespace Martinezdelariva\Railway;

/**
 * Dead-function to one track 1-1 function
 */
class Tee
{
    public function __invoke(callable $callable)
    {
        return function ($input) use ($callable) {
            $callable($input);

            return $input;
        };
    }
}
