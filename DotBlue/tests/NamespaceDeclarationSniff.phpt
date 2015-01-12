<?php

require __DIR__ . '/bootstrap.php';

testSniff('NamespaceDeclarationWithoutUseStatement', 3, 'There must be two blank lines after the namespace declaration. In case there is no use statement. Found 1');
testSniff('NamespaceDeclarationWithUseStatement', 3, 'There must be one blank line after the namespace declaration in case use statement follows. Found 2');
