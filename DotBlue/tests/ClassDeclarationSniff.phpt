<?php

require __DIR__ . '/bootstrap.php';

testSniff('ClassDeclaration', 13, 'There must be one empty line after the body');
