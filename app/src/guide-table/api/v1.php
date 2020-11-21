<?php

$langs = [
    'php' => [
        'show' => "PHP (PCRE)",
        'main' => ["\\", "^", "$", ".", "[ ]", "[^]", "\\b", "|", "( )", "\\1"],
        'greedy' => ["?", "*", "+", "{x, y}", "{x, }", "{, y}"],
        'reluctant' => ["??", "*?", "+?", "{x, y}?", "{x, }?", "{, y}?"],
        'possessive' => ["?+", "*+", "++", "{x, y}+", "{x, }+", "{, y}+"],
        'methods' => ["preg_match | preg_match_all", "preg_replace", "preg_split", "'' (inside simple quotes)", "By Default"]
    ],
    'javascript' => [
        'show' => "Javascript",
        'main' => ["\\", "^", "$", ".", "[ ]", "[^]", "\\b", "|", "( )", "\\1"],
        'greedy' => ["?", "*", "+", "{x, y}", "{x, }", "{, y}"],
        'reluctant' => ["??", "*?", "+?", "{x, y}?", "{x, }?", "{, y}?"],
        'possessive' => ["?+", "*+", "++", "{x, y}+", "{x, }+", "{, y}+"],
        'methods' => ["String(match, matchAll, search) | RegExp(test, exec)", "String(replace) | ", "String(split)", "// (inside slashes)", "By Default"]
    ],
    'java' => [
        'show' => "Java",
        'main' => ["\\\\", "^", "$", ".", "[ ]", "[^]", "\\\\b", "|", "( )", "\\\\1"],
        'greedy' => ["?", "*", "+", "{x, y}", "{x, }", "{, y}"],
        'reluctant' => ["??", "*?", "+?", "{x, y}?", "{x, }?", "{, y}?"],
        'possessive' => ["?+", "*+", "++", "{x, y}+", "{x, }+", "{, y}+"],
        'methods' => ["Matcher.matches | Matcher.find", "Matcher.replaceFirst | Matcher.replaceAll", "Pattern.split", "Doesn't have"]
    ]

];

function getCode($lang, $dir)
{
    return '<pre><code class="'.$lang.'">'.file_get_contents($dir).'</code></pre>';
}

$langs['php']['examples'][]  = getCode('php', 'code/php/example1.php');
$langs['php']['examples'][]  = getCode('php', 'code/php/example2.php');

$langs['javascript']['examples'][]  = getCode('php', 'code/javascript/example1.js');
$langs['javascript']['examples'][]  = getCode('php', 'code/javascript/example2.js');

$langs['java']['examples'][] = getCode('java', 'code/java/example1.java');
$langs['java']['examples'][] = getCode('java', 'code/java/example2.java');

echo json_encode($langs); exit;
