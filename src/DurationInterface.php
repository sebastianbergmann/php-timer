<?php declare(strict_types=1);

/*
 * This file is part of phpunit/php-timer.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace SebastianBergmann\Timer;

interface DurationInterface
{
    public function asNanoseconds(): float;

    public function asMicroseconds(): float;

    public function asMilliseconds(): float;

    public function asSeconds(): float;

    public function asString(): string;
}
