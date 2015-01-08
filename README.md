[![Build Status](https://travis-ci.org/dotblue/CodeSnifferStandard.svg?branch=master)](https://travis-ci.org/dotblue/CodeSnifferStandard)

DotBlue CodeSniffer Standard
============================

This standard overrides some PSR-2 rules and adds some specific dotBlue rules.

Usage
-----

1. Install [squizlabs/PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer)
2. Clone this repository somewhere **(folder must be called 'DotBlue')**
3. Run code sniffer with these parameters: --standard=PATH_TO_DotBlue_ruleset.xml

Pro installation tip
-------------------
In case you installed CodeSniffer globally PEAR/composer you can improve your experience.
After cloning repository you can symlink directory to 'install' code standard to sniffer:

`ln -s PATH_TO_CLONED_DIR PATH_TO_CODE_SNIFFER_INSTALLATION/Standards/DotBlue`
 
Verify it is installed with `phpcs -i` (you should see DotBlue in output). And use it with just `--standard=DotBlue`

Creating rules
--------------

Make a class in Sniffs directory and use PSR-0 with `DotBlue` root namespace;

Filename: `Sniffs/Classes/ClassDeclarationSniff`

Classname: `DotBlue\Sniffs\Classes\ClassDeclarationSniff`

**Please add documentation file for added/edited rules.**

Testing
-------

Uses nette/tester. Create test in tests folder - see any test as example.
Conventions:

- Test filename is as same as sniff name
- Always create php file in tests/invalid and tests/valid folders to test the sniff

Differences from PSR-2
----------------------

- We use tabs
- We do not force line lenght - use your brain an common sense
- We force uppercase constants (incl. TRUE, FALSE, NULL)
- Namespace declaration
	- use 1 empty line in case any use statement follows
	- use 2 empty lines in case no use statement follows
- We force one empty line after class body
- Visibility
	- must not be declared on interface's method
	- must be declared on class's method
- Variable names in method's DocBlock are not allowed
- There must be exactly two spaces between `@param` and type definition

Generating documentation
------------------------

Run `phpcs --standard=DotBlue --generator=HTML > doc.html`

Todo
----

See [issues](https://github.com/dotblue/CodeSnifferStandard/issues)
