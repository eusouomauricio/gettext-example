# gettext-example
Using gettext for php project.

Found a lot of things on the web but no working example.

## Instruction

 1. Prepare your php files with gettext like function
    - [gettext()](http://php.net/manual/en/function.gettext.php), translates a string. If you have dynamic content (no plurials), please use [printf()](http://php.net/manual/en/function.printf.php).
    - [ngettext()](http://php.net/manual/en/function.ngettext.php), for plurials. Please, 0 is not singular but plurial.
 2. If you have a main php loader for contents (view manager), please ... config
 3. Create your pot file with this command xgettext in your console.
```
# One input file
xgettext index.php -o mydomain.pot

# Multiple input file
xgettext *.php -o mydomain.pot
```
    - Bonus: It recommended (from my sources) to edit the pot file. Looking for the CHARSET and chage value for "UTF-8"
 4. Create .po file for each lang with msginit
```
msginit --locale=fr -i mydomain.pot -o my/locale/path/fr_FR/LC_MESSAGES/mydomain.po
```
 5. Use a text editor and translate your po files
 6. Use msgfmt to create the .mo file (binary file for gettext)
```
msgfmt mydomain.po -o mydomain.mo
```

## Sources

 -  [O'Reilly example](http://www.onlamp.com/pub/a/php/2002/06/13/php.html)
 -  [French guy gives some explainations](http://tassedecafe.org/fr/internationaliser-site-web-php-gettext-2878)
 -  [Stackoverflow question about language check](http://stackoverflow.com/questions/18366381/check-if-gettext-language-is-available)
