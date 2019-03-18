/* 1. Doing a search and getting the result */

$regex  = '/^\d([a-z])$/';
$string = '1a';
if (preg_match($regex, $string, $match)) {
    echo $match[0]; // 1a
    echo $match[1]; // a
}

/* 2. Doing a global search and getting the results */

$regex  = '/\d([a-z])/';
$string = '1a2b3c';
if (preg_match_all($regex, $string, $match)) {
   print_r($match);

   /*
        Array (
            [0] => Array
                (
                    [0] => 1a
                    [1] => 2b
                    [2] => 3c
                )
            [1] => Array
                (
                    [0] => a
                    [1] => b
                    [2] => c
                )
        )
    */
}