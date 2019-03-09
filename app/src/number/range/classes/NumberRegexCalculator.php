<?php

namespace RegexLab\NumberRange;

class NumberRegexCalculator
{
    private static $desc = 0;
    private static $asc = 1;
    private $from;
    private $to;

    public function __construct($from, $to)
    {
        $this->from = $from;
        $this->to   = $to;
    }

    public static function resetControl() {
        self::$desc = 0;
        self::$asc  = 1;
    }

    public function calculateNextTo() : string {
        if ($this->areEquals() || $this->isLittleDifference())
            return $this->to;
        if ($this->ascLimit())
            return $this->calculateAsc();
        return $this->calculateDesc();
    }

    private function calculateAsc() {
        $prefix = substr($this->from, 0, strlen($this->from) - self::$asc);
        return $prefix . str_pad('', self::$asc++, '9');
    }

    private function calculateDesc() {
        while ($this->from[self::$desc] == $this->to[self::$desc]) self::$desc++;

        do {
            $limit = self::$desc == strlen($this->to) - 1;
            $prefix = self::$desc > 0 ? substr($this->to, 0, self::$desc) : '';

            $middle = substr($this->to, self::$desc, 1);
            $middle = substr($this->to, self::$desc + 1, 1) == 9 ? $middle : $middle - 1;

            $suffix = str_pad('', strlen($this->from) - (self::$desc++ + 1), 9);
            $result = $prefix . $middle . $suffix;
        } while (preg_match('/^0+|-/', $result));

        return $limit ? $this->to : $result;
    }

    private function ascLimit() {
        if (strlen($this->from) < strlen($this->to)) {
            return self::$asc < strlen($this->to);
        }

        $len = strlen($this->from);
        for ($i = 0; $i < strlen($this->from); $i++) {
            if ($this->from[$i] != $this->to[$i])
                break;
            $len--;
        }

        return self::$asc < $len;
    }

    private function areEquals() {
        return $this->from == $this->to;
    }

    private function isLittleDifference() {
        return substr($this->from, 0, strlen($this->from) - 1) == substr($this->to, 0, strlen($this->to) - 1);
    }
}