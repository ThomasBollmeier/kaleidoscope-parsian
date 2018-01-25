<?php

require("../vendor/autoload.php");

use tbollmeier\kaleidoscope\KaleidoscopeParser;

$code=<<<CODE
answer;
42 * (23 + answer);
CODE;

$parser = new KaleidoscopeParser();

$ast = $parser->parseString($code);
if ($ast) {
    echo $ast->toXml() . "\n";
} else {
    echo $parser->error() . "\n";
}
