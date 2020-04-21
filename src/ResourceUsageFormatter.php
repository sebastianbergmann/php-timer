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

final class ResourceUsageFormatter
{
    /**
     * @psalm-var array<string,int>
     */
    private const SIZES = [
        'GB' => 1073741824,
        'MB' => 1048576,
        'KB' => 1024,
    ];

    /**
     * @throws TimeSinceStartOfRequestNotAvailableException
     */
    public function resourceUsage(?Duration $duration = null): string
    {
        if ($duration === null) {
            if (!isset($_SERVER['REQUEST_TIME_FLOAT'])) {
                throw new TimeSinceStartOfRequestNotAvailableException(
                    'Cannot determine time at which the request started because $_SERVER[\'REQUEST_TIME_FLOAT\'] is not available'
                );
            }

            if (!\is_float($_SERVER['REQUEST_TIME_FLOAT'])) {
                throw new TimeSinceStartOfRequestNotAvailableException(
                    'Cannot determine time at which the request started because $_SERVER[\'REQUEST_TIME_FLOAT\'] is not of type float'
                );
            }

            $duration = Duration::fromMicroseconds((int) (1000000 * (\microtime(true) - $_SERVER['REQUEST_TIME_FLOAT'])));
        }

        return \sprintf(
            'Time: %s, Memory: %s',
            $duration->asString(),
            $this->bytesToString(\memory_get_peak_usage(true))
        );
    }

    private function bytesToString(int $bytes): string
    {
        foreach (self::SIZES as $unit => $value) {
            if ($bytes >= $value) {
                return \sprintf('%.2f %s', $bytes >= 1024 ? $bytes / $value : $bytes, $unit);
            }
        }

        return $bytes . ' byte' . ($bytes !== 1 ? 's' : '');
    }
}
