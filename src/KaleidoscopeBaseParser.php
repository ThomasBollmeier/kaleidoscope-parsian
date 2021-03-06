<?php
/* This file has been generated by the Parsian parser generator 
 * (see http://github.com/thomasbollmeier/parsian)
 * 
 * DO NOT EDIT THIS FILE!
 */
namespace tbollmeier\kaleidoscope;

use tbollmeier\parsian as parsian;
use tbollmeier\parsian\output\Ast;


class KaleidoscopeBaseParser extends parsian\Parser
{
    public function __construct()
    {
        parent::__construct();

        $this->configLexer();
        $this->configGrammar();
    }

    private function configLexer()
    {

        $lexer = $this->getLexer();

        $lexer->addCommentType("#", "\n");


        $lexer->addSymbol(";", "SEMICOLON");
        $lexer->addSymbol("*", "MULT");
        $lexer->addSymbol("+", "PLUS");
        $lexer->addSymbol("(", "LPAR");
        $lexer->addSymbol(")", "RPAR");

        $lexer->addTerminal("/\d+(\.\d+)?/", "NUMBER");
        $lexer->addTerminal("/[a-zA-Z][a-zA-Z0-9]*/", "IDENT");
        $lexer->addTerminal("/./", "UNKNOWN");

        $lexer->addKeyword("def");
        $lexer->addKeyword("extern");

    }

    private function configGrammar()
    {

        $grammar = $this->getGrammar();

        $grammar->rule("kaleidoscope",
            $grammar->many($this->seq_1()),
            true);

        $grammar->setCustomRuleAst("kaleidoscope", function (Ast $ast) {
            $res = new Ast("kaleidoscope", "");
            foreach ($ast->getChildrenById("stmt") as $local_1) {
                $local_1->clearId();
                $res->addChild($local_1);
            }
            return $res;
        });

        $grammar->rule("expr",
            $this->alt_2(),
            false);

        $grammar->setCustomRuleAst("expr", function (Ast $ast) {
            $child = $ast->getChildren()[0];
            $child->clearId();
            return $child;
        });

        $grammar->rule("primary_expr",
            $this->alt_3(),
            false);

        $grammar->setCustomRuleAst("primary_expr", function (Ast $ast) {
            $child = $ast->getChildren()[0];
            $child->clearId();
            return $child;
        });

        $grammar->rule("id_expr",
            $this->seq_2(),
            false);

        $grammar->setCustomRuleAst("id_expr", function (Ast $ast) {
            $res = new Ast("identifier", $ast->getChildren()[0]->getText());
            foreach ($ast->getChildrenById("arg") as $local_1) {
                $local_1->clearId();
                $res->addChild($local_1);
            }
            return $res;
        });

        $grammar->rule("paren_expr",
            $this->seq_4(),
            false);

        $grammar->setCustomRuleAst("paren_expr", function (Ast $ast) {
            $res = new Ast("group", "");
            $local_1 = $ast->getChildrenById("e")[0];
            $local_1->clearId();
            $res->addChild($local_1);
            return $res;
        });

        $grammar->rule("mult_expr",
            $this->seq_5(),
            false);
        $grammar->rule("operator",
            $this->alt_4(),
            false);

        $grammar->setCustomRuleAst("operator", function (Ast $ast) {
            $res = new Ast("operator", $ast->getChildren()[0]->getText());
            return $res;
        });

        $grammar->rule("definition",
            $this->seq_7(),
            false);

        $grammar->setCustomRuleAst("definition", function (Ast $ast) {
            $res = new Ast("definition", "");
            $local_1 = $ast->getChildrenById("p")[0];
            $local_1->clearId();
            $res->addChild($local_1);
            $local_2 = $ast->getChildrenById("e")[0];
            $local_2->clearId();
            $res->addChild($local_2);
            return $res;
        });

        $grammar->rule("prototype",
            $this->seq_8(),
            false);
        $grammar->rule("external",
            $this->seq_9(),
            false);

        $grammar->setCustomRuleAst("external", function (Ast $ast) {
            $res = new Ast("external", "");
            foreach ($ast->getChildrenById("p") as $local_1) {
                $local_1->clearId();
                $res->addChild($local_1);
            }
            return $res;
        });


    }

    private function alt_1()
    {
        $grammar = $this->getGrammar();

        return $grammar->alt()
            ->add($grammar->ruleRef("definition", "stmt"))
            ->add($grammar->ruleRef("external", "stmt"))
            ->add($grammar->ruleRef("expr", "stmt"));
    }

    private function alt_2()
    {
        $grammar = $this->getGrammar();

        return $grammar->alt()
            ->add($grammar->ruleRef("mult_expr"))
            ->add($grammar->ruleRef("primary_expr"));
    }

    private function alt_3()
    {
        $grammar = $this->getGrammar();

        return $grammar->alt()
            ->add($grammar->term("NUMBER"))
            ->add($grammar->ruleRef("id_expr"))
            ->add($grammar->ruleRef("paren_expr"));
    }

    private function alt_4()
    {
        $grammar = $this->getGrammar();

        return $grammar->alt()
            ->add($grammar->term("PLUS"))
            ->add($grammar->term("MULT"));
    }


    private function seq_1()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($this->alt_1())
            ->add($grammar->opt($grammar->term("SEMICOLON")));
    }

    private function seq_2()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("IDENT"))
            ->add($grammar->opt($this->seq_3()));
    }

    private function seq_3()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("LPAR"))
            ->add($grammar->many($grammar->ruleRef("expr", "arg")))
            ->add($grammar->term("RPAR"));
    }

    private function seq_4()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("LPAR"))
            ->add($grammar->ruleRef("expr", "e"))
            ->add($grammar->term("RPAR"));
    }

    private function seq_5()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->ruleRef("primary_expr"))
            ->add($grammar->oneOrMore($this->seq_6()));
    }

    private function seq_6()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->ruleRef("operator"))
            ->add($grammar->ruleRef("primary_expr"));
    }

    private function seq_7()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("DEF"))
            ->add($grammar->ruleRef("prototype", "p"))
            ->add($grammar->ruleRef("expr", "e"));
    }

    private function seq_8()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("IDENT", "func"))
            ->add($grammar->term("LPAR"))
            ->add($grammar->many($grammar->term("IDENT", "arg")))
            ->add($grammar->term("RPAR"));
    }

    private function seq_9()
    {
        $grammar = $this->getGrammar();

        return $grammar->seq()
            ->add($grammar->term("EXTERN"))
            ->add($grammar->ruleRef("prototype", "p"));
    }


}
