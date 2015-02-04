<?php

require __DIR__ . '/bootstrap.php';

testSniff('ClassDeclaration_1', 7, 'There must be one empty line before the class body. Found 0');
testSniff('ClassDeclaration_2', 7, 'There must be one empty line before the class body. Found 2');
testSniff('ClassDeclaration_3', 12, 'There must be one empty line after the body. Found 0');
testSniff('ClassDeclaration_4', 14, 'There must be one empty line after the body. Found 2');
testSniff('ClassDeclaration_5', 7, 'There must be one empty line before the class body. Found 0');
