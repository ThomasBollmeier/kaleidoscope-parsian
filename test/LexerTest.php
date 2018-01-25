<?php

require("../vendor/autoload.php");

use tbollmeier\kaleidoscope\KaleidoscopeParser;
use tbollmeier\parsian\input\StringCharInput;

$code=<<<CODE
answer;
42;
(23 + b);
CODE;

$parser = new KaleidoscopeParser();
$lexer = $parser->getLexer();
$tokenIn = $lexer->createTokenInput(new StringCharInput($code));

$tokenIn->open();
while ($tokenIn->hasMoreTokens()) {
    $token = $tokenIn->nextToken();
    echo $token . "\n";
}
$tokenIn->close();
