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

use function round;
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

        $this->assertSame(1.0, $duration->asNanoseconds());
        $this->assertSame(1.0E-3, $duration->asMicroseconds());
        $this->assertSame(1.0E-6, $duration->asMilliseconds());
        $this->assertSame(1.0E-9, $duration->asSeconds());
    }

    public function testCanBeCreatedFromMicroseconds(): void
    {
        $duration = Duration::fromMicroseconds(1);

        $this->assertSame(1000.0, $duration->asNanoseconds());
        $this->assertSame(1.0, $duration->asMicroseconds());
        $this->assertSame(1.0E-3, $duration->asMilliseconds());
        $this->assertSame(1.0E-6, $duration->asSeconds());
    }

    /**
     * @dataProvider durationProvider
     * @testdox Formats $microseconds microseconds as "$string"
     */
    public function testCanBeFormattedAsString(string $string, int $microseconds): void
    {
        $duration = Duration::fromMicroseconds($microseconds);

        $this->assertSame($string, $duration->asString());
    }

    public function durationProvider(): array
    {
        return [
            ['00:00',        (int) round((0 * 1000000))],
            ['00:00.001',    (int) round((.001 * 1000000))],
            ['00:00.010',    (int) round((.01 * 1000000))],
            ['00:00.100',    (int) round((.1 * 1000000))],
            ['00:00.999',    (int) round((.999 * 1000000))],
            ['00:00.999',    (int) round((.9999 * 1000000))],
            ['00:01',        (int) round((1 * 1000000))],
            ['00:02',        (int) round((2 * 1000000))],
            ['00:59.900',    (int) round((59.9 * 1000000))],
            ['00:59.990',    (int) round((59.99 * 1000000))],
            ['00:59.999',    (int) round((59.999 * 1000000))],
            ['00:59.999',    (int) round((59.9999 * 1000000))],
            ['00:59.001',    (int) round((59.001 * 1000000))],
            ['00:59.010',    (int) round((59.01 * 1000000))],
            ['01:00',        (int) round((60 * 1000000))],
            ['01:01',        (int) round((61 * 1000000))],
            ['02:00',        (int) round((120 * 1000000))],
            ['02:01',        (int) round((121 * 1000000))],
            ['59:59.900',    (int) round((3599.9 * 1000000))],
            ['59:59.990',    (int) round((3599.99 * 1000000))],
            ['59:59.999',    (int) round((3599.999 * 1000000))],
            ['59:59.999',    (int) round((3599.9999 * 1000000))],
            ['59:59.001',    (int) round((3599.001 * 1000000))],
            ['59:59.010',    (int) round((3599.01 * 1000000))],
            ['01:00:00',     (int) round((3600 * 1000000))],
            ['01:00:01',     (int) round((3601 * 1000000))],
            ['01:00:01.900', (int) round((3601.9 * 1000000))],
            ['01:00:01.990', (int) round((3601.99 * 1000000))],
            ['01:00:01.999', (int) round((3601.999 * 1000000))],
            ['01:00:01.999', (int) round((3601.9999 * 1000000))],
            ['01:00:59.999', (int) round((3659.9999 * 1000000))],
            ['01:00:59.001', (int) round((3659.001 * 1000000))],
            ['01:00:59.010', (int) round((3659.01 * 1000000))],
            ['01:59:59.999', (int) round((7199.9999 * 1000000))],
        ];
    }
}
