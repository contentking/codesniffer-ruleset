<?php

require __DIR__ . '/bootstrap.php';

testSniff('PhpDocMethodParametersName', 10, 'Variable names in method\'s DocBlock comments are not allowed.');
testSniff('PhpDocMethodParametersWhitespace', 10, 'There must be two spaces between @param and type. Found 1.');
