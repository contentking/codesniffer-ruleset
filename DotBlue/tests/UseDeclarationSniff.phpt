<?php

require __DIR__ . '/bootstrap.php';

testSniff('UseDeclaration', 5, 'There must be two blank lines after the last USE statement; 1 found;');
