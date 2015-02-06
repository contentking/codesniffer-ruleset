<?php

use DotBlue\CodeSniffer\Helpers\Tester;


require __DIR__ . '/bootstrap.php';

$tester = new Tester();
$tester->setFile('PhpDocMethodParametersName')
	->expectMessage('Variable names in method\'s DocBlock comments are not allowed.')
	->onLine(10)
	->isFixable();

$tester->setFile('PhpDocMethodParametersWhitespace')
	->expectMessage('There must be two spaces between @param and type. Found 1.')
	->onLine(10)
	->isFixable();

$tester->setFile('PhpDocMethodReturnWhitespace')
	->expectMessage('There must be exactly one space between @return and type. Found 2.')
	->onLine(11)
	->isFixable();

$tester->test();
