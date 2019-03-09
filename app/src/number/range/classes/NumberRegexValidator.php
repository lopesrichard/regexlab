<?php

namespace RegexLab\NumberRange;

class NumberRegexValidator
{
    private $from;
    private $to;
    
    public function __construct($from, $to)
    {
        $this->from = $from;
        $this->to   = $to;
    }

    public function validateValues()
    {
        if ($this->from > $this->to) {
            throw new \InvalidArgumentException('Initial value must be less than second');
        }
    }
}