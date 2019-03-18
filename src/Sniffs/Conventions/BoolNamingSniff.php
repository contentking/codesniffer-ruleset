<?php

namespace DotBlue\Sniffs\Conventions;

use PHP_CodeSniffer;


class BoolNamingSniff implements PHP_CodeSniffer\Sniffs\Sniff
{

	public function register()
	{
		return [
			T_DOC_COMMENT_STRING,
		];
	}



	public function process(PHP_CodeSniffer\Files\File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();
		$content = $tokens[$stackPtr]['content'];
		if (preg_match('/boolean/', $content)) {
			$fix = $phpcsFile->addFixableError('Usage of "boolean" is forbidden. Use "bool" instead.', $stackPtr, 'code');

			if ($fix) {
				$phpcsFile->fixer->beginChangeset();
				$phpcsFile->fixer->replaceToken($stackPtr, str_replace('boolean', 'bool', $content));
				$phpcsFile->fixer->endChangeset();
			}
		}
	}

}
