<?php
/**
 *  (c) José Luis Martínez de la Riva <martinezdelariva@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE file
 *  that was distributed with this source code.
 */

declare(strict_types=1);

namespace Martinezdelariva\Railway\Either;

class Left implements Either
{
    private $value;

    public static function of($value)
    {
        return new self($value);
    }

    private function __construct($value)
    {
        $this->value = $value;
    }

    public function value()
    {
        return $this->value;
    }

    public function isLeft(): bool
    {
        return true;
    }

    public function isRight(): bool
    {
        return false;
    }
}
