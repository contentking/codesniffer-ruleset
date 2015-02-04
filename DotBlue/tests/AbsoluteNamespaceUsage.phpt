<?php

require __DIR__ . '/bootstrap.php';

testSniff('AbsoluteNamespaceUsage', 9, 'Using absolute namespaces if forbidden. Import class \'\\StdClass\' with use statement.', FALSE);
testSniff('AbsoluteNamespaceUsage', 16, 'Using absolute namespaces if forbidden. Import class \'\\Nette\\Utils\\Strings\' with use statement.', FALSE);
