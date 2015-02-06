<?php

use DotBlue\CodeSniffer\Helpers\Tester;


require __DIR__ . '/bootstrap.php';

$tester = new Tester();

$tester->setFile('ForceEmptyConstructorParentheses')
	->expectMessage('There must be parentheses after constructor call.')
	->onLine(3)
	->isFixable();

$tester->setFile('ForceEmptyConstructorParenthesesNamespaced')
	->expectMessage('There must be parentheses after constructor call.')
	->onLine(3)
	->isFixable();

$tester->setFile('ForceEmptyConstructorParenthesesInFunctionCall')
	->expectMessage('There must be parentheses after constructor call.')
	->onLine(3)
	->isFixable();

$tester->setFile('ForceEmptyConstructorParenthesesInArray')
	->expectMessage('There must be parentheses after constructor call.')
	->onLine(4)
	->isFixable();

$tester->test();
