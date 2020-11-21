<?php

namespace RegexLab\DateCreator;

class DateRegexCreator
{
    const SEPARATORS  = [1 => '', 2 => '\-', 3 => '\/', 4 => '\.', 5 => '[.\/-]'];
    const FORMATS     = [1 => 'YMD', 2 => 'YDM', 3 => 'DMY'];

    private $separator;
    private $format;
    private $from;
    private $to;
    private $onlyFullYear;
    private $forceLeadingZero;
    private $namedGroups;

    public function __construct($params = [])
    {
        $this->separator        = $params['separator']        ?? null;
        $this->format           = $params['format']           ?? null;
        $this->from             = $params['from']             ?? null;
        $this->to               = $params['to']               ?? null;
        $this->flags            = $params['flags']            ?? null;
    }

    public function validate()
    {
        if ($this->from < 1900 || $this->to > 2900) {
            throw new \InvalidArgumentException('Invalid range values');
        }
    }

    public function getRegex()
    {
        $year = $this->getYearInterval();
        $keys      = $this->getKeys();
        $separator = self::SEPARATORS[$this->separator];

        $group  = in_array('g', $this->flags);
        $zeros  = in_array('z', $this->flags);
        $full   = in_array('f', $this->flags);
        $border = in_array('b', $this->flags);

        $regex[$keys[0]]  =        ($group ? '(?J)' : '');
        $regex[$keys[1]]  =        ($border ? '\b' : '^') . '('  . ($group ? '?<date>' : '')  . '(?:';
        $regex[$keys[2]]  = '(?:';
        $regex[$keys[3]]  = '('  . ($group ? '?<day>' : '')   . '0' . ($zeros ? '' : '?') . '[1-9]|1[0-9]|2[0-8])';
        $regex[$keys[4]]  =        ($separator);
        $regex[$keys[5]]  = '('  . ($group ? '?<month>' : '') . '0' . ($zeros ? '' : '?') . '[1-9]|1[0-2])';
        $regex[$keys[6]]  = '|';
        $regex[$keys[7]]  = '('  . ($group ? '?<day>' : '')   . '29|30)';
        $regex[$keys[8]]  =        ($separator);
        $regex[$keys[9]]  = '('  . ($group ? '?<month>' : '') . '0' . ($zeros ? '' : '?') . '(?!2)(?:[1-9])|1[0-2])';
        $regex[$keys[10]]  = '|';
        $regex[$keys[11]] = '('  . ($group ? '?<day>' : '')   . '31)';
        $regex[$keys[12]] =        ($separator);
        $regex[$keys[13]] = '('  . ($group ? '?<month>' : '') . '0' . ($zeros ? '' : '?') . '[13578]|1[02])';
        $regex[$keys[14]] = ')';
        $regex[$keys[15]] =        ($separator);
        $regex[$keys[16]] = '('  . ($group ? '?<year>' : '')  . '(?:' . $year['pre'] . ')' . ($full ? '' : '?') . '(?:' . $year['pos'] . '))';
        $regex[$keys[17]] = '|';
        $regex[$keys[18]] = '('  . ($group ? '?<day>' : '')   . '29)';
        $regex[$keys[19]] =        ($separator);
        $regex[$keys[20]] = '('  . ($group ? '?<month>' : '') . '0' . ($zeros ? '' : '?') . '2)';
        $regex[$keys[21]] =        ($separator);
        $regex[$keys[22]] = '('  . ($group ? '?<year>' : '')  . '(?:' . $year['pre'] . ')' . ($full ? '' : '?') . '(?=[02468][048]|[13579][26])' . '(?:'. $year['pos'] . '))';
        $regex[$keys[23]] = '))' . ($border ? '\b' : '$');

        ksort($regex, SORT_NUMERIC);
        return implode('', $regex);
    }

    private function getYearInterval()
    {
        $year['pre'] = $this->getRegexRange(0);
        $year['pos'] = $this->getRegexRange(2);
        return $year;
    }

    private function getRegexRange($start)
    {
        $from = substr($this->from, $start, 2);
        $to   = substr($this->to, $start, 2);
        $ret  = $this->getSmallYear($from, $to);
        return preg_replace('/\(|\)/', '', $ret['regex']);
    }

    private function getSmallYear($from, $to)
    {
        $url = 'number/range/api/v1.php';

        if ($from <= $to) {
            return $ret = json_decode(file_get_contents($url."/{$from}/{$to}"), true);
        }

        $ret = json_decode(file_get_contents($url."/{$from}/99"), true);
        $ret['regex'] .= '|' . json_decode(file_get_contents($url."/00/{$to}"), true)['regex'];

        return $ret;
    }

    private function getKeys()
    {
        switch (self::FORMATS[$this->format]) {
            case 'YMD': return [0, 1, 4, 7, 6, 5, 8, 11, 10, 9, 12, 15, 14, 13, 16, 3, 2, 17, 22, 21, 20, 19, 18, 23];
            case 'YDM': return [0, 1, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 3, 2, 17, 20, 21, 22, 19, 18, 23];
            case 'DMY': return [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23];
        }
    }
}
