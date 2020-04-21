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
 *
 * @uses \SebastianBergmann\Timer\Duration
 */
final class TimerTest extends TestCase
{
    /**
     * @var Timer
     */
    private $timer;

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
