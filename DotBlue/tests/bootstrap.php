<?php

use Tester\Assert;


require __DIR__ . '/../../vendor/autoload.php';

\Tester\Environment::setup();
define('PHP_CODESNIFFER_IN_TESTS', TRUE);
define('PHP_CODESNIFFER_CBF', TRUE);

function createSniffer()
{
	$sniffer = new PHP_CodeSniffer();
	$sniffer->initStandard(__DIR__ . '/../ruleset.xml');
	return $sniffer;
}


function testSniff($sniffName, $expectedLineWithError, $expectedMessage, $fixable = TRUE)
{
	$sniffer = createSniffer();

	// test valid
	$file = $sniffer->processFile(__DIR__ . '/valid/' . $sniffName . '.php');
	$errors = $file->getErrors();
	Assert::true(empty($errors));

	// test invalid
	$file = $sniffer->processFile(__DIR__ . '/invalid/' . $sniffName . '.php');
	$errors = $file->getErrors();
	Assert::true(isset($errors[$expectedLineWithError]));
	$errors = $errors[$expectedLineWithError];

	$errorFound = FALSE;
	foreach ($errors as $error) {
		if ($error[0]['message'] === $expectedMessage) {
			$errorFound = TRUE;
			break;
		}
	}

	if (!$errorFound) {
		Assert::fail('Required error message "' . $expectedMessage . '" not found on line "' . $expectedLineWithError . '"');
	}

	if (!$fixable) {
		return [$sniffer, $file];
	}

	exec('../../vendor/bin/phpcbf invalid/' . $sniffName . '.php --standard=../ruleset.xml --suffix=.fixed', $out, $status);
	if ($status === 1) {
		$content = file_get_contents(__DIR__ . '/invalid/' . $sniffName . '.php.fixed');
		Assert::matchFile(__DIR__ . '/valid/' . $sniffName . '.php', $content);
	}

	return [$sniffer, $file];
}
