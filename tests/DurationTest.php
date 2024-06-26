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
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Duration::class)]
#[UsesClass(Timer::class)]
final class DurationTest extends TestCase
{
    /**
     * @return list<array{0: string, 1: float}>
     */
    public static function durationProvider(): array
    {
        return [
            ['00:00',        round((0 * 1000000))],
            ['00:00.001',    round((.001 * 1000000))],
            ['00:00.010',    round((.01 * 1000000))],
            ['00:00.100',    round((.1 * 1000000))],
            ['00:00.999',    round((.999 * 1000000))],
            ['00:00.999',    round((.9999 * 1000000))],
            ['00:01',        round((1 * 1000000))],
            ['00:02',        round((2 * 1000000))],
            ['00:59.900',    round((59.9 * 1000000))],
            ['00:59.990',    round((59.99 * 1000000))],
            ['00:59.999',    round((59.999 * 1000000))],
            ['00:59.999',    round((59.9999 * 1000000))],
            ['00:59.001',    round((59.001 * 1000000))],
            ['00:59.010',    round((59.01 * 1000000))],
            ['01:00',        round((60 * 1000000))],
            ['01:01',        round((61 * 1000000))],
            ['02:00',        round((120 * 1000000))],
            ['02:01',        round((121 * 1000000))],
            ['59:59.900',    round((3599.9 * 1000000))],
            ['59:59.990',    round((3599.99 * 1000000))],
            ['59:59.999',    round((3599.999 * 1000000))],
            ['59:59.999',    round((3599.9999 * 1000000))],
            ['59:59.001',    round((3599.001 * 1000000))],
            ['59:59.010',    round((3599.01 * 1000000))],
            ['01:00:00',     round((3600 * 1000000))],
            ['01:00:01',     round((3601 * 1000000))],
            ['01:00:01.900', round((3601.9 * 1000000))],
            ['01:00:01.990', round((3601.99 * 1000000))],
            ['01:00:01.999', round((3601.999 * 1000000))],
            ['01:00:01.999', round((3601.9999 * 1000000))],
            ['01:00:59.999', round((3659.9999 * 1000000))],
            ['01:00:59.001', round((3659.001 * 1000000))],
            ['01:00:59.010', round((3659.01 * 1000000))],
            ['01:59:59.999', round((7199.9999 * 1000000))],
        ];
    }

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

    #[DataProvider('durationProvider')]
    #[TestDox('Formats $microseconds microseconds as "$string"')]
    public function testCanBeFormattedAsString(string $string, float $microseconds): void
    {
        $duration = Duration::fromMicroseconds($microseconds);

        $this->assertSame($string, $duration->asString());
    }
}
