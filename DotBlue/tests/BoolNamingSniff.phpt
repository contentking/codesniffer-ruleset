<?php

require __DIR__ . '/bootstrap.php';

testSniff('BoolNaming', 10, 'Usage of "boolean" is forbidden. Use "bool" instead.');
testSniff('BoolNaming', 20, 'Usage of "boolean" is forbidden. Use "bool" instead.');
testSniff('BoolNaming', 24, 'Usage of "boolean" is forbidden. Use "bool" instead.');
