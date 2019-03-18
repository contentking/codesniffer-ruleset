<?php

namespace DotBlue\Sniffs\Scope;

use PHP_CodeSniffer;


class MethodScopeSniff extends PHP_CodeSniffer\Standards\Squiz\Sniffs\Scope\MethodScopeSniff
{

	protected function processTokenWithinScope(PHP_CodeSniffer\Files\File $phpcsFile, $stackPtr, $currScope)
	{
		$tokens = $phpcsFile->getTokens();

		$methodName = $phpcsFile->getDeclarationName($stackPtr);
		if ($methodName === NULL) {
			// Ignore closures.
			return;
		}

		$modifier = NULL;
		for ($i = ($stackPtr - 1); $i > 0; $i--) {
			if ($tokens[$i]['line'] < $tokens[$stackPtr]['line']) {
				break;
			} elseif (isset(PHP_CodeSniffer\Util\Tokens::$scopeModifiers[$tokens[$i]['code']]) === TRUE) {
				$modifier = $i;
				break;
			}
		}

		if ($modifier === NULL && !$this->isInterface($phpcsFile)) {
			$error = 'Visibility must be declared on method "%s"';
			$data = [$methodName];
			$fix = $phpcsFile->addFixableError($error, $stackPtr, 'Missing', $data);

			if ($fix) {
				$phpcsFile->fixer->beginChangeset();
				$phpcsFile->fixer->addContentBefore($stackPtr, 'public ');
				$phpcsFile->fixer->endChangeset();
			}
		}

		if ($modifier !== NULL && $this->isInterface($phpcsFile)) {
			$error = 'Visibility must not be declared on method "%s" in interface';
			$data = [$methodName];
			$fix = $phpcsFile->addFixableError($error, $stackPtr, 'Missing', $data);

			if ($fix) {
				$phpcsFile->fixer->beginChangeset();
				$phpcsFile->fixer->replaceToken($stackPtr - 2, '');
				$phpcsFile->fixer->replaceToken($stackPtr - 1, '');
				$phpcsFile->fixer->endChangeset();
			}
		}

	}



	private function isInterface(PHP_CodeSniffer\Files\File $phpcsFile)
	{
		return $phpcsFile->findNext(T_INTERFACE, 0);
	}

}
