DotBlue CodeSniffer Standard
============================

This standard overrides some PSR-2 rules.

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
