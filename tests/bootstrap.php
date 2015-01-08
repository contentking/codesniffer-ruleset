<?php

use Tester\Assert;


require __DIR__ . '/../vendor/autoload.php';

\Tester\Environment::setup();
define('PHP_CODESNIFFER_IN_TESTS', TRUE);

function testSniff($sniffName, $expectedLineWithError, $expectedMessage)
{
	$sniffer = new PHP_CodeSniffer();
	$sniffer->initStandard(__DIR__ . '/../ruleset.xml');

	// test invalid
	$file = $sniffer->processFile(__DIR__ . '/invalid/' . $sniffName . '.php');
	$errors = $file->getErrors();
	Assert::true(isset($errors[$expectedLineWithError]));
	$error = array_pop($errors[$expectedLineWithError]);
	Assert::same($expectedMessage, $error[0]['message']);

	// test valid
	$file = $sniffer->processFile(__DIR__ . '/valid/' . $sniffName . '.php');
	$errors = $file->getErrors();
	Assert::true(empty($errors));
}
