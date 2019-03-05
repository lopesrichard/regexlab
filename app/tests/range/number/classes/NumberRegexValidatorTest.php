<?php

use RegexLab\NumberRange\NumberRegexValidator;
use PHPUnit\Framework\TestCase;

class NumberRegexValidatorTest extends TestCase
{
    public function test_ShouldThrowsException_WhenFirstNumberLessThanSecond() {
        self::expectException(\InvalidArgumentException::class);
        $nrv = new NumberRegexValidator(600, 300);
        $nrv->validateValues();
    }
}