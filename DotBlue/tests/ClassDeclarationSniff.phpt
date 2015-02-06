<?php

use DotBlue\CodeSniffer\Helpers\Tester;


require __DIR__ . '/bootstrap.php';

$tester = new Tester();
$tester->setFile('ClassDeclaration_1')
	->expectMessage('There must be one empty line before the class body. Found 0')
	->onLine(7)
	->isFixable();

$tester->setFile('ClassDeclaration_2')
	->expectMessage('There must be one empty line before the class body. Found 2')
	->onLine(7)
	->isFixable();

$tester->setFile('ClassDeclaration_3')
	->expectMessage('There must be one empty line after the body. Found 0')
	->onLine(12)
	->isFixable();

$tester->setFile('ClassDeclaration_4')
	->expectMessage('There must be one empty line after the body. Found 2')
	->onLine(14)
	->isFixable();

$tester->setFile('ClassDeclaration_5')
	->expectMessage('There must be one empty line before the class body. Found 0')
	->onLine(7)
	->isFixable();

$tester->test();
