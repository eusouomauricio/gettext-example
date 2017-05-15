# gettext-example
Using gettext for php project.

Found a lot of things on the web but no working example.

## How works this example

1. Clone this project with git or download it
2. Put the content into your web server folder
3. Go to src/index.php on your navigator (for example http://localhost/path/to/project/src/index.php)
4. Enjoy (or not...)

## Tests

 -  Success: On Ubuntu 16.04 with PHP7.0
 -  Success: On Ubuntu 17.04 with PHP7.0
 -  Success: Host infomaniak.ch Linux with PHP5.6
 -  Failed: Windows 10 with PHP5.6

## How make your own internationalization

__First, sorry for my english__

### Install gettext on your server

Please check if you have install and enable gettext.

#### Linux (Ubuntu 16.04 & 17.04)

This explaination is for Apache2 with PHP7 (not tested with PHP5 but it should be similar)

 -  Install gettext module
```
sudo apt install gettext php-gettext locales
```
 -  Check if your language is installed on your server
```
locales -a
```
 -  If not, install it with this command (replace xx by your language
    [ISO 639-1 code](https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes))
```
sudo apt install language-pack-xx-base
```
 -  In your php.ini (default location is /etc/php/7.0/apache2/php.ini), looking for the "extension=php\_gettext.dll".
    If this line is commented, comment out it.
 -  Restart apache2
```
sudo service apache2 restart
```

#### Windows (xampp)

Actually, it seems that the module is installed but it does not work actually on my computer
(Windows 10, xampp with PHP 5.6).

### Create your content

I assume you have all your pages in a same directory.

#### Prepare your script

You need to prepare the [I18N support](https://en.wikipedia.org/wiki/Internationalization_and_localization). If you have
a view manager, put this script before calling the content. Or just put this script on the top of each page content.

```php
<?php

// I18N Support
$lang = "en\_US.utf8"; // Default language

// You can do something else, so many ways...
// Be carefule, use  xx\_CC where xx is lang and cc is country
// If it does not work, add try xx\_CC.utf8
if(!empty($_GET["lang"]))
  $lang = $_GET["lang"];

setlocale(LC_ALL, $lang);
// If no translation, try to comment out those two lines
// putenv("LANG={$lang}");
// putenv("LANGUAGE={$lang}");

// use domain if you got multiple project on the same server. This is not necessarily your server domain name.
// It can be your project name
$domain = 'mydomain';
// Where is your locale directory, relative and absolute path work
bindtextdomain($domain, $locale_directory);
textdomain($domain);

?>
```

#### Use gettext in yours pages

Please replace all string by following thoses examples:
 -  Static text, use [gettext() or \_()](http://php.net/manual/en/function.gettext.php)
```php
<?php
$text = gettext("My string content");
$text = _("My string content"); // It's same
?>
```
 -  Dynamic content (no plurial), use [printf()](http://php.net/manual/en/function.printf.php) with
    [gettext() or \_()](http://php.net/manual/en/function.gettext.php) or
    [sprintf()](http://php.net/manual/fr/function.sprintf.php) get formatted valued
```php
<?php
printf(gettext("Welcome %s! Today: %4d-%02d-%02d"), $username, date("Y"), date("m"), date("d"));
?>
```
 -  Plurial, use [ngettext()](http://php.net/manual/fr/function.ngettext.php) for plurial
```php
<?php
$text = sprintf(ngettext("I have %d apple", "I have %d apples", $count), $count);
?>
```

### Get your .pot (template for each language)

 -  Go to your pages directory
 -  If you have one file to translate, use this command (replace mydomain by the same value of $domain in your script).
```
xgettext myfile.php -o path/to/locale/mydomain.pot
```
 -  If you have multiple files, use this command (replace mydomain by the same value of $domain in your script).
```
xgettext -n *.php -o path/to/locale/mydomain.pot
```

### Translation (create .po files)

 -  Prepare now the structure of locale directory. For example, you have fr\_CH, de\_DE, it\_IT:
    -  locale
       -  fr\_CH
          -  LC\_MESSAGES
       -  de\_DE
          -  LC\_MESSAGES
       -  it\_IT
          -  LC\_MESSAGES
 -  For each language exec this command
```
cd path/to/locale
msginit --locale=fr -i mydomain.pot -o fr\_CH/LS_MESSAGES/mydomain.po
msginit --locale=de -i mydomain.pot -o de\_DE/LS_MESSAGES/mydomain.po
msginit --locale=it -i mydomain.pot -o it\_IT/LS_MESSAGES/mydomain.po
```
 -  For each mydomain.po file, use a text editor and translate.
    msgid is the string id, msgstr is the translation.
    Please change the charset for UTF-8 in the header of each file.

### Create binary files (create .mo files)

 -  For each language, use this command
```
cd path/to/locale
msgfmt fr\_CH/LS_MESSAGES/mydomain.po -o fr\_CH/LS_MESSAGES/mydomain.mo
msgfmt de\_DE/LS_MESSAGES/mydomain.po -o de\_DE/LS_MESSAGES/mydomain.mo
msgfmt it\_IT/LS_MESSAGES/mydomain.po -o it\_IT/LS_MESSAGES/mydomain.mo
```

 -  Voilà! This is the theory, maybe it will work first time if you are lucky but with this example, you are close to success (or not...)!

## Sources

 -  [O'Reilly example](http://www.onlamp.com/pub/a/php/2002/06/13/php.html)
 -  [French guy gives some explainations](http://tassedecafe.org/fr/internationaliser-site-web-php-gettext-2878)
 -  [Stackoverflow question about language check](http://stackoverflow.com/questions/18366381/check-if-gettext-language-is-available)
 -  [Stackoverflow question about missing locale lang](http://stackoverflow.com/questions/22456520/setting-up-gettext-for-php-under-ubuntu)

## Contributing

[Contact me](mailto:nhuhoai.vo@franicflow.ch) if you found a bug or any request.

## License

Please refer to [LICENSE](LICENSE).
