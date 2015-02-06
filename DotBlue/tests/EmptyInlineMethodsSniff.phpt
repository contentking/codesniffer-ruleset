<?php

use DotBlue\CodeSniffer\Helpers\Tester;


require __DIR__ . '/bootstrap.php';

$tester = new Tester();
$tester->setFile('EmptyInlineMethod')
	->expectMessage('Inline method is allowed only for methods without body')
	->onLine(13);
$tester->test();
