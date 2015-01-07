<?php

namespace DotBlue\Sniffs\Scope;


use PHP_CodeSniffer_File;
use PHP_CodeSniffer_Tokens;


class MethodScopeSniff extends \Squiz_Sniffs_Scope_MethodScopeSniff
{

	protected function processTokenWithinScope(PHP_CodeSniffer_File $phpcsFile, $stackPtr, $currScope)
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
			} else if (isset(PHP_CodeSniffer_Tokens::$scopeModifiers[$tokens[$i]['code']]) === TRUE) {
				$modifier = $i;
				break;
			}
		}

		if ($modifier === NULL && !$this->isInterface($phpcsFile)) {
			$error = 'Visibility must be declared on method "%s"';
			$data = [$methodName];
			$phpcsFile->addError($error, $stackPtr, 'Missing', $data);
		}

		if ($modifier !== NULL && $this->isInterface($phpcsFile)) {
			$error = 'Visibility must not be declared on method "%s" in interface';
			$data = [$methodName];
			$phpcsFile->addError($error, $stackPtr, 'Missing', $data);
		}

	}


	private function isInterface(PHP_CodeSniffer_File $phpcsFile)
	{
		return $phpcsFile->findNext(T_INTERFACE, 0);
	}


}
