<?php

use Calculator\Validator;

class ValidatorTest extends PHPUnit_Framework_TestCase
{
    protected $_validator;

    public function setUp()
    {
        parent::setUp();
        $this->_validator = new Validator();
    }

    public function testPHPUnitRun()
    {
        $this->assertTrue(true);
    }

    public function testDueDateValidatorInstance()
    {
        $this->assertInstanceOf(Validator::class, $this->_validator);
    }

    public function testCheckStartDateTimeAvailable()
    {
        $this->assertTrue($this->_validator->isStartDateValid(new DateTime("2015-08-24 11:14")));
        $this->assertFalse($this->_validator->isStartDateValid(new DateTime("2015-08-23 11:14")));
        $this->assertFalse($this->_validator->isStartDateValid(new DateTime("2015-08-24 06:14")));
        $this->assertFalse($this->_validator->isStartDateValid(new DateTime("2015-08-24 19:14")));
    }

    public function testHourIsValid()
    {
        $this->assertFalse($this->_validator->isHourValid('asdasdasd'));
        $this->assertFalse($this->_validator->isHourValid(11.2));
        $this->assertFalse($this->_validator->isHourValid(-2));
        $this->assertTrue($this->_validator->isHourValid(2));
    }

}