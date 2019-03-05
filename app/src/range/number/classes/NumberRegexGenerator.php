<?php

namespace RegexLab\NumberRange;

use RegexLab\NumberRange\NumberRegexValidator;
use RegexLab\NumberRange\NumberRegexCalculator;

class NumberRegexGenerator
{
    public function __construct() {}

    public static function getRegexFromRange(string $from, string $to) : string {
        $validator = new NumberRegexValidator($from, $to);
        $validator->validateValues();

        $regex = self::createRegexFromRange($from, $to, $to);
        $regex = self::cleanRegex($regex);
        $regex = self::removeRedundancy($regex);
        return '(' . $regex . ')';
    }

    private static function createRegexFromRange(string $from, string $to, string $final) : string {
        $calculator = new NumberRegexCalculator($from, $to);
        $to = $calculator->calculateNextTo();
        $regex = self::getNextRegex($from, $to);

        if ((int) $to < (int) $final) {
            $regex .= '|' . self::createRegexFromRange(++$to, $final, $final);
        }

        NumberRegexCalculator::resetControl();
        return $regex;
    }

    private static function getNextRegex(string $from, string $to, String $regex = '') : string {
        for($i = 0; $i < strlen($from); $i++) {
            if ($from[$i] > $to[$i])
                return "";
            $regex .= $from[$i] == $to[$i] ? $to[$i] : "[{$from[$i]}-{$to[$i]}]";
        }
        return $regex;
    }

    private static function cleanRegex(string $regex)  : string{
        return preg_replace('/\|{2,}/', '|', trim($regex, '|'));
    }

    private static function removeRedundancy(string $regex) : string {
        while (preg_match('/(\[\d-\d\])\1+/', $regex, $match)) {
            $count = count(explode($match[1], $match[0])) - 1;
            $regex = preg_replace('/'.quotemeta($match[0]).'/', $match[1] . "{{$count}}", $regex, 1);
        }
        return $regex;
    }
}