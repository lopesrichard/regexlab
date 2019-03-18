/* 3. Replacing a text and saving it in another variable */

$regex  = '/\d([a-z])/';
$replacement = '@';
$string = '1a2b3c';

$newString = preg_replace($regex, $replacement, $string);
echo $newString; // @@@

/* 4. The same but this time adding a limit */

$limit = 1;
$newString = preg_replace($regex, $replacement, $string, $limit);
echo $newString; // @2b3c

/* 5. Splitting a string into an array */

$regex = '/\d/';
$array = preg_split($regex, $string);
print_r($array);

/*
    Array (
        [0] => 
        [1] => a
        [2] => b
        [3] => c
    )
*/