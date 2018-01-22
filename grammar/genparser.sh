#!/bin/bash

php ../vendor/tbollmeier/parsian/scripts/parsiangen.php \
    -pKaleidoscopeBaseParser \
    -ntbollmeier\\kaleidoscope \
    --out=../src/KaleidoscopeBaseParser.php \
    kaleidoscope.parsian 
 