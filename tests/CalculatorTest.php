<?php

use Calculator\DueDateCalculator;
use Calculator\Validator;

class CalculatorTest extends PHPUnit_Framework_TestCase
{
    protected $_calculator;

    public function setUp()
    {
        parent::setUp();
        $this->_calculator = new DueDateCalculator(new Validator());
    }

    public function testPHPUnitRun()
    {
        $this->assertTrue(true);
    }

    public function testDueDateCalculatorInstance()
    {
        $this->assertInstanceOf(DueDateCalculator::class, $this->_calculator);
    }

    public function testStartDate()
    {
        $this->assertEquals(
            'Start date not valid!',
            $this->_calculator->getDueDate(new DateTime("2015-08-23 11:14"), 12)
        );
    }

    public function testHourIsNumeric()
    {
        $this->assertEquals(
            'Hour not valid!',
            $this->_calculator->getDueDate(new DateTime("2015-08-24 11:14"), 'asdasdasd')
        );
    }

    public function testDueDateEndsOnStartDate()
    {
        $this->assertEquals(
            '2015-08-24 12:14',
            $this->_calculator->getDueDate(new DateTime("2015-08-24 11:14"), 1)
        );
    }

    public function testDueDateDidNotEndsOnStartDate()
    {
        $this->assertEquals(
            '2015-08-25 13:14',
            $this->_calculator->getDueDate(new DateTime("2015-08-24 11:14"), 10)
        );
    }

    public function testDueDateDidNotEndsOnStartDateWithWeekend()
    {
        $this->assertEquals(
            '2015-08-31 13:14',
            $this->_calculator->getDueDate(new DateTime("2015-08-28 11:14"), 10)
        );
    }
}