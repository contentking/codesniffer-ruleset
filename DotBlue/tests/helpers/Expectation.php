<?php

namespace DotBlue\CodeSniffer\Helpers;

use PHP_CodeSniffer;
use Tester\Assert;


class Expectation
{

	/** @var string */
	private $expectedMessage;

	/** @var int[] */
	private $expectedOnLines = [];

	/** @var bool */
	private $isFixable = FALSE;

	/** @var PHP_CodeSniffer */
	private $sniffer;

	/** @var TestedFile */
	private $testedFile;



	public function __construct($message, TestedFile $testedFile)
	{
		$this->expectedMessage = $message;
		$this->testedFile = $testedFile;
	}



	/**
	 * Expect an error message on given line
	 * @param  int
	 * @return $this
	 */
	public function onLine($line)
	{
		$this->expectedOnLines[] = $line;
		return $this;
	}



	/**
	 * Expect an error message on given lines
	 * @param  int []
	 * @return $this
	 */
	public function onLines(array $lines)
	{
		foreach ($lines as $line) {
			$this->expectedOnLines[] = $line;
		}
		return $this;
	}



	/**
	 * Set sniff as fixable. The .fixed variant of invalid file will be tested against valid file
	 * @return $this
	 */
	public function isFixable()
	{
		$this->isFixable = TRUE;
		return $this;
	}



	/**
	 * @param  PHP_CodeSniffer
	 */
	public function evaluate(PHP_CodeSniffer $sniffer)
	{
		$this->sniffer = $sniffer;
		$this->testValid();
		$this->testInvalid();

		if ($this->isFixable) {
			$this->testFix();
		}
	}



	/**
	 * @return TestedFile
	 */
	public function getFile()
	{
		return $this->testedFile;
	}



	private function testValid()
	{
		$file = $this->sniffer->processFile(Tester::$setup['validDir'] . $this->testedFile->getName() . '.php');
		$errors = $file->getErrors();
		Assert::true(empty($errors));
	}



	private function testInvalid()
	{
		$file = $this->sniffer->processFile(Tester::$setup['invalidDir'] . $this->testedFile->getName() . '.php');
		$allErrors = $file->getErrors();

		foreach ($this->expectedOnLines as $line) {
			if (!isset($allErrors[$line])) {
				Assert::fail('Expected error on line "' . $line . '" not found.');
			}

			$errorsOnLine = $allErrors[$line];

			$errorFound = FALSE;
			foreach ($errorsOnLine as $errors) {
				foreach ($errors as $error) {
					if ($error['message'] === $this->expectedMessage) {
						$errorFound = TRUE;
						break;
					}
				}
			}

			if (!$errorFound) {
				Assert::fail('Required error message "' . $this->expectedMessage . '" not found on line "' . $line . '"');
			}
		}

	}



	private function testFix()
	{
		exec(Tester::$setup['fixerPath'] . ' ' . Tester::$setup['invalidDir'] . $this->testedFile->getName() . '.php --standard=../ruleset.xml --suffix=.fixed', $out, $status);
		if ($status === 1) {
			$content = file_get_contents(Tester::$setup['invalidDir'] . $this->testedFile->getName() . '.php.fixed');
			Assert::matchFile(Tester::$setup['validDir'] . $this->testedFile->getName() . '.php', $content);
		}
		unlink(Tester::$setup['invalidDir'] . $this->testedFile->getName() . '.php.fixed');
	}

}