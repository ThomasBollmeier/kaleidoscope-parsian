<?php

require("../vendor/autoload.php");

use tbollmeier\kaleidoscope\KaleidoscopeParser;


$parser = new KaleidoscopeParser();

$ast = $parser->parseFile("code.txt");
if ($ast) {
    echo $ast->toXml() . "\n";
} else {
    echo $parser->error() . "\n";
}
