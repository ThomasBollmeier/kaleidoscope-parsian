<?php

require("../vendor/autoload.php");

use tbollmeier\kaleidoscope\KaleidoscopeParser;
use tbollmeier\parsian\input\FileCharInput;

$parser = new KaleidoscopeParser();
$lexer = $parser->getLexer();
$tokenIn = $lexer->createTokenInput(new FileCharInput("code.txt"));

$tokenIn->open();
while ($tokenIn->hasMoreTokens()) {
    $token = $tokenIn->nextToken();
    echo $token . "\n";
}
$tokenIn->close();
