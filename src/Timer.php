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

final class Timer
{
    private const SIZES = [
        'GB' => 1073741824,
        'MB' => 1048576,
        'KB' => 1024,
    ];

    /**
     * @var float[]
     */
    private static $startTimes = [];

    public static function start(): void
    {
        self::$startTimes[] = \hrtime(true) / 1000000;
    }

    public static function stop(): float
    {
        return (\hrtime(true) / 1000000) - \array_pop(self::$startTimes);
    }

    public static function bytesToString(float $bytes): string
    {
        foreach (self::SIZES as $unit => $value) {
            if ($bytes >= $value) {
                return \sprintf('%.2f %s', $bytes >= 1024 ? $bytes / $value : $bytes, $unit);
            }
        }

        return $bytes . ' byte' . ((int) $bytes !== 1 ? 's' : '');
    }

    public static function secondsToTimeString(float $timeInSeconds): string
    {
        $timeInMilliseconds    = \round($timeInSeconds * 1000);
        $hours                 = \floor($timeInMilliseconds / 60 / 60 / 1000);
        $hoursAsInteger        = (int) $hours;
        $hoursInMilliseconds   = $hours * 60 * 60 * 1000;
        $minutes               = \floor($timeInMilliseconds / 60 / 1000) % 60;
        $minutesAsInteger      = $minutes;
        $minutesInMilliseconds = $minutes * 60 * 1000;
        $seconds               = \floor(($timeInMilliseconds - $hoursInMilliseconds - $minutesInMilliseconds) / 1000);
        $secondsAsInteger      = (int) $seconds;
        $secondsInMilliseconds = $seconds * 1000;
        $milliseconds          = $timeInMilliseconds - $hoursInMilliseconds - $minutesInMilliseconds - $secondsInMilliseconds;
        $millisecondsAsInteger = (int) $milliseconds;

        $result = [];

        if ($hoursAsInteger > 0) {
            if ($hoursAsInteger === 1) {
                $result[] = '1 hour';
            } else {
                $result[] = $hoursAsInteger . ' hours';
            }
        }

        if ($minutesAsInteger > 0) {
            if ($minutesAsInteger === 1) {
                $result[] = '1 minute';
            } else {
                $result[] = $minutesAsInteger . ' minutes';
            }
        }

        if ($secondsAsInteger > 0) {
            if ($secondsAsInteger === 1) {
                $result[] = '1 second';
            } else {
                $result[] = $secondsAsInteger . ' seconds';
            }
        }

        if ($millisecondsAsInteger > 0) {
            if ($millisecondsAsInteger === 1) {
                $result[] = '1 millisecond';
            } else {
                $result[] = $millisecondsAsInteger . ' milliseconds';
            }
        }

        if (!empty($result)) {
            return \implode(', ', $result);
        }

        return '0 milliseconds';
    }

    /**
     * @throws RuntimeException
     */
    public static function timeSinceStartOfRequest(): string
    {
        if (isset($_SERVER['REQUEST_TIME_FLOAT'])) {
            $startOfRequest = $_SERVER['REQUEST_TIME_FLOAT'];
        } elseif (isset($_SERVER['REQUEST_TIME'])) {
            $startOfRequest = $_SERVER['REQUEST_TIME'];
        } else {
            throw new RuntimeException('Cannot determine time at which the request started');
        }

        return self::secondsToTimeString(\microtime(true) - $startOfRequest);
    }

    /**
     * @throws RuntimeException
     */
    public static function resourceUsage(): string
    {
        return \sprintf(
            'Time: %s, Memory: %s',
            self::timeSinceStartOfRequest(),
            self::bytesToString(\memory_get_peak_usage(true))
        );
    }
}
