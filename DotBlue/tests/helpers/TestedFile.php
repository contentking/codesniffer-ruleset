<?php

namespace DotBlue\CodeSniffer\Helpers;

use PHP_CodeSniffer;


class TestedFile
{

	/** @var Expectation[] */
	private $expectations = [];

	/** @var string */
	private $file;



	public function __construct($file)
	{
		$this->file = $file;
	}



	public function expectMessage($message)
	{
		$expectation = new Expectation($message, $this);
		$this->expectations[] = $expectation;
		return $expectation;
	}



	public function evaluate(PHP_CodeSniffer $sniffer)
	{
		foreach ($this->expectations as $expectation) {
			$expectation->evaluate($sniffer);
		}
	}



	/** @return string */
	public function getName()
	{
		return $this->file;
	}

}
