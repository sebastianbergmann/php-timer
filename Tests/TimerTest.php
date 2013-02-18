<?php
/**
 * PHP_Timer
 *
 * Copyright (c) 2010-2013, Sebastian Bergmann <sebastian@phpunit.de>.
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the name of Sebastian Bergmann nor the names of his
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @package    PHP
 * @subpackage Timer
 * @author     Sebastian Bergmann <sebastian@phpunit.de>
 * @copyright  2010 Sebastian Bergmann <sebastian@phpunit.de>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @link       http://github.com/sebastianbergmann/php-timer
 * @since      File available since Release 1.0.0
 */

require_once dirname(dirname(__FILE__)) . '/PHP/Timer.php';

/**
 * Tests for PHP_Timer.
 *
 * @package    PHP
 * @subpackage Timer
 * @author     Sebastian Bergmann <sebastian@phpunit.de>
 * @copyright  2010-2013 Sebastian Bergmann <sebastian@phpunit.de>
 * @license    http://www.opensource.org/licenses/BSD-3-Clause  The BSD 3-Clause License
 * @version    Release: @package_version@
 * @link       http://github.com/sebastianbergmann/php-timer
 * @since      Class available since Release 1.0.0
 */
class PHP_TimerTest extends PHPUnit_Framework_TestCase
{
    private $timer;

    protected function setUp()
    {
        $this->timer = new PHP_Timer;
    }

    /**
     * @covers PHP_Timer::start
     * @covers PHP_Timer::stop
     */
    public function testStartStop()
    {
        $this->assertInternalType('float', $this->timer->stop());
    }

    /**
     * @covers PHP_Timer::secondsToTimeString
     */
    public function testSecondsToTimeString()
    {
        $this->assertEquals('0 ms', $this->timer->secondsToTimeString(0));
        $this->assertEquals('1 ms', $this->timer->secondsToTimeString(.001));
        $this->assertEquals('10 ms', $this->timer->secondsToTimeString(.01));
        $this->assertEquals('100 ms', $this->timer->secondsToTimeString(.1));
        $this->assertEquals('999 ms', $this->timer->secondsToTimeString(.999));
        $this->assertEquals('999 ms', $this->timer->secondsToTimeString(.9999));
        $this->assertEquals('1 second', $this->timer->secondsToTimeString(1));
        $this->assertEquals('2 seconds', $this->timer->secondsToTimeString(2));
        $this->assertEquals('59.9 seconds', $this->timer->secondsToTimeString(59.9));
        $this->assertEquals('59.99 seconds', $this->timer->secondsToTimeString(59.99));
        $this->assertEquals('59.999 seconds', $this->timer->secondsToTimeString(59.999));
        $this->assertEquals('59.999 seconds', $this->timer->secondsToTimeString(59.9999));
        $this->assertEquals('59.001 seconds', $this->timer->secondsToTimeString(59.001));
        $this->assertEquals('59.01 seconds', $this->timer->secondsToTimeString(59.01));
        $this->assertEquals('01:00:000', $this->timer->secondsToTimeString(60));
        $this->assertEquals('01:01:000', $this->timer->secondsToTimeString(61));
        $this->assertEquals('02:00:000', $this->timer->secondsToTimeString(120));
        $this->assertEquals('02:01:000', $this->timer->secondsToTimeString(121));
        $this->assertEquals('59:59:900', $this->timer->secondsToTimeString(3599.9));
        $this->assertEquals('59:59:990', $this->timer->secondsToTimeString(3599.99));
        $this->assertEquals('59:59:999', $this->timer->secondsToTimeString(3599.999));
        $this->assertEquals('59:59:999', $this->timer->secondsToTimeString(3599.9999));
        $this->assertEquals('59:59:001', $this->timer->secondsToTimeString(3599.001));
        $this->assertEquals('59:59:010', $this->timer->secondsToTimeString(3599.01));
        $this->assertEquals('01:00:00:000', $this->timer->secondsToTimeString(3600));
        $this->assertEquals('01:00:01:000', $this->timer->secondsToTimeString(3601));
        $this->assertEquals('01:00:01:900', $this->timer->secondsToTimeString(3601.9));
        $this->assertEquals('01:00:01:990', $this->timer->secondsToTimeString(3601.99));
        $this->assertEquals('01:00:01:999', $this->timer->secondsToTimeString(3601.999));
        $this->assertEquals('01:00:01:999', $this->timer->secondsToTimeString(3601.9999));
        $this->assertEquals('01:00:59:999', $this->timer->secondsToTimeString(3659.9999));
        $this->assertEquals('01:00:59:001', $this->timer->secondsToTimeString(3659.001));
        $this->assertEquals('01:00:59:010', $this->timer->secondsToTimeString(3659.01));
        $this->assertEquals('01:59:59:999', $this->timer->secondsToTimeString(7199.9999));
    }

    /**
     * @covers PHP_Timer::timeSinceStartOfRequest
     */
    public function testTimeSinceStartOfRequest()
    {
        $this->assertStringMatchesFormat(
          '%f %s', $this->timer->timeSinceStartOfRequest()
        );
    }


    /**
     * @covers PHP_Timer::resourceUsage
     */
    public function testResourceUsage()
    {
        $this->assertStringMatchesFormat(
          'Time: %s, Memory: %s', $this->timer->resourceUsage()
        );
    }
}
