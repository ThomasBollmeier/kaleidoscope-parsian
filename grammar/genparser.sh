#!/bin/bash

php ../vendor/tbollmeier/parsian/scripts/parsiangen.php \
    -pKaleidoscopeBaseParser \
    -ntbollmeier\\kaleidoscope \
    kaleidoscope.parsian \
    > ../src/KaleidoscopeBaseParser.php