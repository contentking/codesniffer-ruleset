<?php

require __DIR__ . '/bootstrap.php';

testSniff('ForceEmptyConstructorParentheses', 3, 'There must be parentheses after constructor call.');
testSniff('ForceEmptyConstructorParenthesesNamespaced', 3, 'There must be parentheses after constructor call.');
testSniff('ForceEmptyConstructorParenthesesInFunctionCall', 3, 'There must be parentheses after constructor call.');
testSniff('ForceEmptyConstructorParenthesesInArray', 4, 'There must be parentheses after constructor call.');
