<?php

namespace DotBlue\Sniffs\PhpDoc;


use PHP_CodeSniffer_File;
use PHP_CodeSniffer_Sniff;


class MethodParametersSniff implements PHP_CodeSniffer_Sniff
{


	public function register()
	{
		return [
			T_DOC_COMMENT_TAG
		];
	}


	public function process(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();

		if ($tokens[$stackPtr]['content'] !== '@param') {
			return;
		}

		$whitespace = $tokens[$stackPtr + 1]['content'];

		if ($whitespace !== '  ') {
			$phpcsFile->addError('There must be two spaces between @param and type. Found %s.', $stackPtr, 'Whitespace', [strlen($whitespace)]);
		}

		$paramDefinition = $tokens[$stackPtr + 2]['content'];

		if (strpos($paramDefinition, '$') !== FALSE) {
			$phpcsFile->addError('Variable names in method\'s DocBlock comments are not allowed.', $stackPtr, 'ParameterName');
		}

	}

}
