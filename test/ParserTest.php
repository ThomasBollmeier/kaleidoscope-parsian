<?php

require("../vendor/autoload.php");
require("../src/KaleidoscopeBaseParser.php");

use tbollmeier\kaleidoscope\KaleidoscopeBaseParser;
use tbollmeier\parsian\input\StringCharInput;

$code=<<<CODE

answer = 42

CODE;

$parser = new KaleidoscopeBaseParser();
$lexer = $parser->getLexer();
$tokenIn = $lexer->createTokenInput(new StringCharInput($code));

$tokenIn->open();
while ($tokenIn->hasMoreTokens()) {
    $token = $tokenIn->nextToken();
    echo $token . "\n";
}
$tokenIn->close();
