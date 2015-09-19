<?php

/*
 * This file is part of the Carbon package.
 *
 * (c) Brian Nesbitt <brian@nesbot.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cake\Chronos\Test\DateTime;

use Cake\Chronos\Carbon;
use TestFixture;

class InstanceTest extends TestFixture
{

    /**
     * @dataProvider classNameProvider
     * @return void
     */
    public function testInstanceFromDateTime($class)
    {
        $dating = $class::instance(\DateTime::createFromFormat('Y-m-d H:i:s', '1975-05-21 22:32:11'));
        $this->assertCarbon($dating, 1975, 5, 21, 22, 32, 11);
    }

    /**
     * @dataProvider classNameProvider
     * @return void
     */
    public function testInstanceFromDateTimeKeepsTimezoneName($class)
    {
        $dating = $class::instance(\DateTime::createFromFormat('Y-m-d H:i:s',
            '1975-05-21 22:32:11')->setTimezone(new \DateTimeZone('America/Vancouver')));
        $this->assertSame('America/Vancouver', $dating->tzName);
    }

    /**
     * @dataProvider classNameProvider
     * @return void
     */
    public function testInstanceFromDateTimeKeepsMicros($class)
    {
        $micro    = 254687;
        $datetime = \DateTime::createFromFormat('Y-m-d H:i:s.u', '2014-02-01 03:45:27.' . $micro);
        $carbon   = $class::instance($datetime);
        $this->assertSame($micro, $carbon->micro);
    }
}
