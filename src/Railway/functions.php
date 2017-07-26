<?php
/**
 *  (c) José Luis Martínez de la Riva <martinezdelariva@gmail.com>
 *
 *  For the full copyright and license information, please view the LICENSE file
 *  that was distributed with this source code.
 */

declare(strict_types=1);

namespace Martinezdelariva\Railway;

function bind(callable $switch): callable {
    return (new Bind())($switch);
};

function unite(callable $one, callable $other): callable {
    return (new Unite())($one, $other);
};

function lift(callable $oneTrack): callable {
    return (new Lift())($oneTrack);
};

function map(callable $oneTrack): callable {
    return (new Map())($oneTrack);
};

function tee(callable $callable): callable {
    return (new Tee())($callable);
};

function tryCatch(callable $oneTrack): callable {
    return (new TryCatch())($oneTrack);
};

function doubleMap(callable $oneTrackRight, callable $oneTrackLeft): callable {
    return (new DoubleMap())($oneTrackRight, $oneTrackLeft);
};

function plus(callable $addRight, callable $addLeft, callable $switch1, callable $switch2): callable {
    return (new Plus())($addRight, $addLeft, $switch1, $switch2);
};
