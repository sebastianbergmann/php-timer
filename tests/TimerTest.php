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

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Timer::class)]
#[UsesClass(Duration::class)]
final class TimerTest extends TestCase
{
    private Timer $timer;

    protected function setUp(): void
    {
        $this->timer = new Timer;
    }

    public function testCanBeStartedAndStopped(): void
    {
        $this->timer->start();

        /* @noinspection UnnecessaryAssertionInspection */
        $this->assertInstanceOf(Duration::class, $this->timer->stop());
    }

    public function testCannotBeStoppedWhenItWasNotStarted(): void
    {
        $this->expectException(NoActiveTimerException::class);

        $this->timer->stop();
    }
}
