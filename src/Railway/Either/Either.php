<?php
/**
 *  (c) José Luis Martínez de la Riva <martinezdelariva@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE file
 *  that was distributed with this source code.
 */

declare(strict_types=1);

namespace Martinezdelariva\Railway\Either;

interface Either
{
    /**
     * @param mixed $value
     *
     * @return static
     */
    public static function of($value);

    /**
     * @return mixed
     */
    public function value();

    /**
     * @return bool
     */
    public function isLeft(): bool;

    /**
     * @return bool
     */
    public function isRight(): bool;
}
