<?php

use RegexLab\NumberRange\NumberRegexGenerator;
use PHPUnit\Framework\TestCase;

class NumberRegexGeneratorTest extends TestCase
{
    public function test_Massive()
    {
        for ($i = 0; $i < 1000; $i++) {
            $number = $i + 1000;
            $regex = NumberRegexGenerator::getRegexFromRange($i, $number);
            for ($j = $i; $j <= $number; $j += 9) {
                $result = preg_match($regex, $j);
                self::assertEquals(1, $result);
            }
        }
    }
}