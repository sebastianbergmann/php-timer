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

use PHPUnit\Framework\TestCase;

/**
 * @covers \SebastianBergmann\Timer\Duration
 *
 * @uses \SebastianBergmann\Timer\Timer
 */
final class DurationTest extends TestCase
{
    public function testCanBeCreatedFromNanoseconds(): void
    {
        $duration = Duration::fromNanoseconds(1);

        $this->assertSame(1, $duration->asNanoseconds());
        $this->assertSame(1.0E-3, $duration->asMicroseconds());
        $this->assertSame(1.0E-6, $duration->asMilliseconds());
        $this->assertSame(1.0E-9, $duration->asSeconds());
    }

    public function testCanBeCreatedFromMicroseconds(): void
    {
        $duration = Duration::fromMicroseconds(1);

        $this->assertSame(1000, $duration->asNanoseconds());
        $this->assertSame(1.0, $duration->asMicroseconds());
        $this->assertSame(1.0E-3, $duration->asMilliseconds());
        $this->assertSame(1.0E-6, $duration->asSeconds());
    }

    /**
     * @dataProvider durationProvider
     */
    public function testCanBeFormattedAsString(string $string, float $seconds): void
    {
        $duration = Duration::fromMicroseconds((int) \round(($seconds * 1000000)));

        $this->assertSame($string, $duration->asString());
    }

    public function durationProvider(): array
    {
        return [
            ['00:00', 0],
            ['00:00.001', .001],
            ['00:00.010', .01],
            ['00:00.100', .1],
            ['00:00.999', .999],
            ['00:00.999', .9999],
            ['00:01', 1],
            ['00:02', 2],
            ['00:59.900', 59.9],
            ['00:59.990', 59.99],
            ['00:59.999', 59.999],
            ['00:59.999', 59.9999],
            ['00:59.001', 59.001],
            ['00:59.010', 59.01],
            ['01:00', 60],
            ['01:01', 61],
            ['02:00', 120],
            ['02:01', 121],
            ['59:59.900', 3599.9],
            ['59:59.990', 3599.99],
            ['59:59.999', 3599.999],
            ['59:59.999', 3599.9999],
            ['59:59.001', 3599.001],
            ['59:59.010', 3599.01],
            ['01:00:00', 3600],
            ['01:00:01', 3601],
            ['01:00:01.900', 3601.9],
            ['01:00:01.990', 3601.99],
            ['01:00:01.999', 3601.999],
            ['01:00:01.999', 3601.9999],
            ['01:00:59.999', 3659.9999],
            ['01:00:59.001', 3659.001],
            ['01:00:59.010', 3659.01],
            ['01:59:59.999', 7199.9999],
        ];
    }
}
