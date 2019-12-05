<?php

namespace DotBlue\Sniffs\PhpDoc;

use PHP_CodeSniffer;


class MethodParametersSniff implements PHP_CodeSniffer\Sniffs\Sniff
{

	public function register()
	{
		return [
			T_DOC_COMMENT_TAG
		];
	}



	public function process(PHP_CodeSniffer\Files\File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();

		if ($tokens[$stackPtr]['content'] === '@return') {
			$this->processReturn($phpcsFile, $stackPtr, $tokens);
		}
	}



	private function processReturn(PHP_CodeSniffer\Files\File $phpcsFile, $stackPtr, $tokens)
	{
		$whitespace = $tokens[$stackPtr + 1]['content'];

		if ($whitespace !== ' ') {
			$fix = $phpcsFile->addFixableError('There must be exactly one space between @return and type. Found %s.', $stackPtr, 'Whitespace', [strlen($whitespace)]);

			if ($fix) {
				$phpcsFile->fixer->beginChangeset();
				$phpcsFile->fixer->replaceToken($stackPtr + 1, ' ');
				$phpcsFile->fixer->endChangeset();
			}
		}
	}

}
