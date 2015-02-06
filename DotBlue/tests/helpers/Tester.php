<?php

namespace DotBlue\CodeSniffer\Helpers;


use PHP_CodeSniffer;


class Tester
{

	public static $setup = [];

	/** @var TestedFile[] */
	private $testedFiles = [];



	public static function setup($setup)
	{
		self::$setup = $setup;
	}



	public function setFile($file)
	{
		$testedFile = new TestedFile($file);
		$this->testedFiles[] = $testedFile;
		return $testedFile;
	}



	public function test()
	{
		define('PHP_CODESNIFFER_IN_TESTS', TRUE);
		define('PHP_CODESNIFFER_CBF', TRUE);

		$sniffer = new PHP_CodeSniffer();
		$sniffer->initStandard(self::$setup['ruleset']);

		foreach ($this->testedFiles as $testedFile) {
			$testedFile->evaluate($sniffer);
		}
	}

}
