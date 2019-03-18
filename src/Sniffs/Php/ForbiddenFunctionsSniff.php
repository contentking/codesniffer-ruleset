<?php

namespace DotBlue\Sniffs\Php;

use PHP_CodeSniffer;


class ForbiddenFunctionsSniff extends PHP_CodeSniffer\Standards\Generic\Sniffs\PHP\ForbiddenFunctionsSniff
{

	public $forbiddenFunctions = [
		'd' => NULL,
		'dump' => NULL,
		'var_dump' => NULL,
	];

}
