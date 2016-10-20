<?php
namespace Cirici\Test\Validation;

use Cake\I18n\Time;
use Cake\TestSuite\TestCase;
use Cirici\Validation\DatesValidation;

class DatesValidationTest extends TestCase
{
    public function testFuture()
    {
        $future = new Time();
        $future->modify('+2 days');
        // Check with DateTime object
        $this->assertTrue(DatesValidation::future($future));
        // Check with array / string
        $this->assertTrue(DatesValidation::future([
            'year' => $future->year,
            'month' => $future->month,
            'day' => $future->day,
            'hour' => $future->hour,
            'minute' => $future->minute
        ]));
    }

    public function testPast()
    {
        $past = new Time();
        $past->modify('-2 days');
        // Check with DateTime object
        $this->assertTrue(DatesValidation::past($past));
        // Check with array / string
        $this->assertTrue(DatesValidation::past([
            'year' => $past->year,
            'month' => $past->month,
            'day' => $past->day,
            'hour' => $past->hour,
            'minute' => $past->minute
        ]));
    }

    public function testToday()
    {
        $today = new Time();
        // Check with DateTime object
        $this->assertTrue(DatesValidation::today($today));
        // Check with array / string
        $this->assertTrue(DatesValidation::today([
            'year' => $today->year,
            'month' => $today->month,
            'day' => $today->day,
            'hour' => $today->hour,
            'minute' => $today->minute
        ]));
        // Check does not validate another day rather than today
        $tomorrow = new Time();
        $tomorrow->modify('+1 day');
        $this->assertFalse(DatesValidation::today($tomorrow));
    }

    /**
     * @depends testToday
     */
    public function testNotToday()
    {
        $tomorrow = new Time();
        $tomorrow->modify('+1 day');
        // Check with DateTime object
        $this->assertTrue(DatesValidation::notToday($tomorrow));
        // Check with array / string
        $this->assertTrue(DatesValidation::notToday([
            'year' => $tomorrow->year,
            'month' => $tomorrow->month,
            'day' => $tomorrow->day,
            'hour' => $tomorrow->hour,
            'minute' => $tomorrow->minute
        ]));
        // Check does not validate for today
        $today = new Time();
        $this->assertFalse(DatesValidation::notToday($today));
    }
}
