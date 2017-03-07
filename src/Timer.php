<?php
/*
 * This file is part of the PHP_Timer package.
 *
 * (c) Sebastian Bergmann <sebastian@phpunit.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Utility class for timing.
 */
class PHP_Timer
{
    /**
     * @var array
     */
    private static $times = array(
      'hour'   => 3600000,
      'minute' => 60000,
      'second' => 1000
    );

    /**
     * @var array
     */
    private static $startTimes = array();

    /**
     * Starts the timer.
     */
    public static function start()
    {
        array_push(self::$startTimes, microtime(true));
    }

    /**
     * Stops the timer and returns the elapsed time.
     *
     * @return float
     */
    public static function stop()
    {
        return microtime(true) - array_pop(self::$startTimes);
    }

    /**
     * Formats the elapsed time as a string.
     *
     * @param  float  $time
     * @return string
     */
    public static function secondsToTimeString($time)
    {
        $ms = round($time * 1000);

        foreach (self::$times as $unit => $value) {
            if ($ms >= $value) {
                $time = floor($ms / $value * 100.0) / 100.0;

                return $time . ' ' . ($time == 1 ? $unit : $unit . 's');
            }
        }

        return $ms . ' ms';
    }

    /**
     * Formats the elapsed time since the start of the request as a string.
     *
     * @return string
     *
     * @throws RuntimeException
     */
    public static function timeSinceStartOfRequest()
    {
        if (isset($_SERVER['REQUEST_TIME_FLOAT'])) {
            $startOfRequest = $_SERVER['REQUEST_TIME_FLOAT'];
        } elseif (isset($_SERVER['REQUEST_TIME'])) {
            $startOfRequest = $_SERVER['REQUEST_TIME'];
        } else {
            throw new RuntimeException('Cannot determine time at which the request started');
        }

        return self::secondsToTimeString(microtime(true) - $startOfRequest);
    }

    /**
     * Returns the resources (time, memory) of the request as a string.
     *
     * @return string
     *
     * @throws RuntimeException
     */
    public static function resourceUsage()
    {
        return sprintf(
            'Time: %s, Memory: %4.2fMB',
            self::timeSinceStartOfRequest(),
            memory_get_peak_usage(true) / 1048576
        );
    }
}
