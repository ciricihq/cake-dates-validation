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
}
