<?php

namespace tbollmeier\kaleidoscope;

class KaleidoscopeParser extends KaleidoscopeBaseParser
{
    public function __construct()
    {
        parent::__construct();

        $this->getLexer()->enableMultipleTypesPerToken();
    }
}