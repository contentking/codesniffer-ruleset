<?php

namespace DotBlue\Sniffs\Classes;

use PHP_CodeSniffer_File;
use PSR2_Sniffs_Classes_ClassDeclarationSniff;


class ClassDeclarationSniff extends PSR2_Sniffs_Classes_ClassDeclarationSniff
{

	public function processClose(PHP_CodeSniffer_File $phpcsFile, $stackPtr)
	{
		$tokens = $phpcsFile->getTokens();

		// Just in case.
		if (isset($tokens[$stackPtr]['scope_closer']) === FALSE) {
			return;
		}

		// Check that the closing brace comes right after the code body.
		$closeBrace = $tokens[$stackPtr]['scope_closer'];
		$prevContent = $phpcsFile->findPrevious(T_WHITESPACE, ($closeBrace - 1), NULL, TRUE);
		if ($prevContent !== $tokens[$stackPtr]['scope_opener']
			&& $tokens[$prevContent]['line'] !== ($tokens[$closeBrace]['line'] - 2)
		) {
			$error = 'There must be one empty line after the body';
			$data = [$tokens[$stackPtr]['content']];
			$fix = $phpcsFile->addFixableError($error, $closeBrace, 'CloseBraceAfterBody', $data);

			if ($fix === TRUE) {
				$phpcsFile->fixer->beginChangeset();
				for ($i = ($prevContent + 1); $i < $closeBrace; $i++) {
					$phpcsFile->fixer->replaceToken($i, '' . $phpcsFile->eolChar);
				}

				if (strpos($tokens[$prevContent]['content'], $phpcsFile->eolChar) === FALSE) {
					$phpcsFile->fixer->replaceToken($closeBrace, $phpcsFile->eolChar . $tokens[$closeBrace]['content']);
				}

				$phpcsFile->fixer->endChangeset();
			}
		}

		// Check the closing brace is on it's own line, but allow
		// for comments like "//end class".
		$nextContent = $phpcsFile->findNext(T_COMMENT, ($closeBrace + 1), NULL, TRUE);
		if ($tokens[$nextContent]['content'] !== $phpcsFile->eolChar
			&& $tokens[$nextContent]['line'] === $tokens[$closeBrace]['line']
		) {
			$type = strtolower($tokens[$stackPtr]['content']);
			$error = 'Closing %s brace must be on a line by itself';
			$data = [$tokens[$stackPtr]['content']];
			$phpcsFile->addError($error, $closeBrace, 'CloseBraceSameLine', $data);
		}

	}

}
