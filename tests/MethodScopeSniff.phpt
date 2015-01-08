<?php

require __DIR__ . '/bootstrap.php';

testSniff('MethodVisibilityInClass', 9, 'Visibility must be declared on method "foo"');
testSniff('MethodVisibilityInInterface', 9, 'Visibility must not be declared on method "foo" in interface');
