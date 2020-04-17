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
 * @covers \SebastianBergmann\Timer\Timer
 */
final class TimerTest extends TestCase
{
    public function testCanBeStartedAndStopped(): void
    {
        $this->assertIsFloat(Timer::stop());
    }

    public function testCanFormatTimeSinceStartOfRequest(): void
    {
        $this->assertStringMatchesFormat('%f %s', Timer::timeSinceStartOfRequest());
    }

    /**
     * @backupGlobals enabled
     */
    public function testCanFormatSinceStartOfRequestWhenRequestTimeIsNotAvailableAsFloat(): void
    {
        if (isset($_SERVER['REQUEST_TIME_FLOAT'])) {
            unset($_SERVER['REQUEST_TIME_FLOAT']);
        }

        $this->assertStringMatchesFormat('%f %s', Timer::timeSinceStartOfRequest());
    }

    /**
     * @backupGlobals enabled
     */
    public function testCannotFormatTimeSinceStartOfRequestWhenRequestTimeIsNotAvailable(): void
    {
        if (isset($_SERVER['REQUEST_TIME_FLOAT'])) {
            unset($_SERVER['REQUEST_TIME_FLOAT']);
        }

        if (isset($_SERVER['REQUEST_TIME'])) {
            unset($_SERVER['REQUEST_TIME']);
        }

        $this->expectException(RuntimeException::class);

        Timer::timeSinceStartOfRequest();
    }

    public function testCanFormatResourceUsage(): void
    {
        $this->assertStringMatchesFormat('Time: %s, Memory: %f %s', Timer::resourceUsage());
    }

    /**
     * @dataProvider secondsProvider
     */
    public function testCanFormatSecondsAsString(string $string, float $seconds): void
    {
        $this->assertEquals($string, Timer::secondsToTimeString($seconds));
    }

    public function secondsProvider(): array
    {
        return [
            ['0 milliseconds', 0],
            ['1 millisecond', .001],
            ['10 milliseconds', .01],
            ['100 milliseconds', .1],
            ['999 milliseconds', .999],
            ['1 second', .9999],
            ['1 second', 1],
            ['2 seconds', 2],
            ['59 seconds, 900 milliseconds', 59.9],
            ['59 seconds, 990 milliseconds', 59.99],
            ['59 seconds, 999 milliseconds', 59.999],
            ['1 minute', 59.9999],
            ['59 seconds, 1 millisecond', 59.001],
            ['59 seconds, 10 milliseconds', 59.01],
            ['1 minute', 60],
            ['1 minute, 1 second', 61],
            ['2 minutes', 120],
            ['2 minutes, 1 second', 121],
            ['59 minutes, 59 seconds, 900 milliseconds', 3599.9],
            ['59 minutes, 59 seconds, 990 milliseconds', 3599.99],
            ['59 minutes, 59 seconds, 999 milliseconds', 3599.999],
            ['1 hour', 3599.9999],
            ['59 minutes, 59 seconds, 1 millisecond', 3599.001],
            ['59 minutes, 59 seconds, 10 milliseconds', 3599.01],
            ['1 hour', 3600],
            ['1 hour, 1 second', 3601],
            ['1 hour, 1 second, 900 milliseconds', 3601.9],
            ['1 hour, 1 second, 990 milliseconds', 3601.99],
            ['1 hour, 1 second, 999 milliseconds', 3601.999],
            ['1 hour, 2 seconds', 3601.9999],
            ['1 hour, 1 minute', 3659.9999],
            ['1 hour, 59 seconds, 1 millisecond', 3659.001],
            ['1 hour, 59 seconds, 10 milliseconds', 3659.01],
            ['2 hours', 7199.9999],
        ];
    }

    /**
     * @dataProvider bytesProvider
     */
    public function testCanFormatBytesAsString(string $string, float $bytes): void
    {
        $this->assertEquals($string, Timer::bytesToString($bytes));
    }

    public function bytesProvider(): array
    {
        return [
            ['0 bytes', 0],
            ['1 byte', 1],
            ['1023 bytes', 1023],
            ['1.00 KB', 1024],
            ['1.50 KB', 1.5 * 1024],
            ['2.00 MB', 2 * 1048576],
            ['2.50 MB', 2.5 * 1048576],
            ['3.00 GB', 3 * 1073741824],
            ['3.50 GB', 3.5 * 1073741824],
        ];
    }
}
