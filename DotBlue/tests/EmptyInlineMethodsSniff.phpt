<?php

require __DIR__ . '/bootstrap.php';

testSniff('EmptyInlineMethod', 13, 'Inline method is allowed only for methods without body', FALSE);
