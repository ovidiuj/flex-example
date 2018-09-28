<?php

namespace App\DoctrineExtension;


use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\Lexer;
use Doctrine\ORM\Query\SqlWalker;
use Doctrine\ORM\Query\Parser;

class DayOfWeek extends FunctionNode
{
    public $date;

    /**
     * @param SqlWalker $sqlWalker
     * @return string
     * @override
     */
    public function getSql(SqlWalker $sqlWalker)
    {
        return "DAYOFWEEK(" . $sqlWalker->walkArithmeticPrimary($this->date) . ")";
    }

    /**
     * @param Parser $parser
     * @override
     */
    public function parse(Parser $parser)
    {
        $parser->match(Lexer::T_IDENTIFIER);
        $parser->match(Lexer::T_OPEN_PARENTHESIS);

        $this->date = $parser->ArithmeticPrimary();

        $parser->match(Lexer::T_CLOSE_PARENTHESIS);
    }
}