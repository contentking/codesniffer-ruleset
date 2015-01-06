DotBlue CodeSniffer Standard
============================

This standard overrides some PSR-2 rules and adds some specific dotBlue rules.

Usage
-----

1. Install [squizlabs/PHP_CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer)
2. Clone this repository somewhere **(folder must be called 'DotBlue')**
3. Run code sniffer with these parameters: --standard=PATH_TO_DotBlue_ruleset.xml --tab-width=4

Creating rules
--------------

Make a class in Sniffs directory. Due to fucked up autoloading classname must be composed this way:

Filename: `Sniffs/Classes/ClassDeclarationSniff`

Classname: `DotBlue_Sniffs_Classes_ClassDeclarationSniff`

Excluded rules
--------------

- Generic.WhiteSpace.DisallowTabIndent
- Generic.Files.LineLength
- Generic.PHP.LowerCaseKeyword
- PSR2.Namespaces.UseDeclaration
- PSR2.Classes.ClassDeclaration

Added rules
-----------

- Generic.PHP.UpperCaseConstant
- DotBlue.Classes.ClassDeclaration
	- force 1 empty line after the body
- DotBlue.Namespaces.UseDeclaration
	- force 2 empty lines after the last use
