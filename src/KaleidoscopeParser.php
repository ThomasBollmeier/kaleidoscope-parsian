<?php

namespace tbollmeier\kaleidoscope;

use tbollmeier\parsian\output\Ast;

class KaleidoscopeParser extends KaleidoscopeBaseParser
{
    public function __construct()
    {
        parent::__construct();

        $this->getLexer()->enableMultipleTypesPerToken();

        $g = $this->getGrammar();

        $g->setCustomRuleAst("prototype", function (Ast $ast) {
            $ret = new Ast("signature");

            $func = $ast->getChildrenById("func")[0];
            $ret->setAttr("name", $func->getText());

            $args = $ast->getChildrenById("arg");
            foreach ($args as $arg) {
                $arg->clearId();
                $ret->addChild($arg);
            }

            return $ret;
        });

        $g->setCustomTermAst("NUMBER", function(Ast $ast) {
            return new Ast("number", $ast->getText());
        });

        $g->setCustomTermAst("IDENT", function(Ast $ast) {
            return new Ast("identifier", $ast->getText());
        });
    }
}