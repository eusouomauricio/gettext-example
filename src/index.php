<?php

/**
 *  @file       index.php
 *  @version    0.1
 *  @date       2017-05-15
 *  @author     VO, Nhu-Hoai Robert <nhuhoai.vo@franicflow.ch>
 *  @copyright  FRANIC Flow Sàrl
 *  @brief      Example using gettext on php project
 */

// Check if gettext is enable
if(!function_exists("gettext")) die("gettext is not enable");

// Default language
$lang = "en_US.utf8";

// Detect langage (just use GET parameter "lang")
if(isset($_GET["lang"])) {
  switch(strtolower($_GET["lang"])) {
    case "fr":
    case "fr_ch":
    case "fr_fr":
    case "fr_ca":
    case "fr_be":
    case "fr_lu":
      $lang = "fr_FR.utf8";
      break;
    case "de":
    case "de_at":
    case "de_li":
    case "de_de":
    case "de_lu":
    case "de_ch":
      $lang = "de_DE.utf8";
      break;
  }
}

$username = "Anonymous";
// Detect username test param
if(isset($_GET["username"])) {
  $username = urldecode($_GET["username"]);
}

$count = 0;
// Detect count number test param
if(isset($_GET["count"])) {
  $count = intval($_GET["count"]);
}

// I18N support
// Source: http://www.onlamp.com/pub/a/php/2002/06/13/php.html
// Source: http://tassedecafe.org/fr/internationaliser-site-web-php-gettext-2878
// Source: http://stackoverflow.com/questions/18366381/check-if-gettext-language-is-available

// If nothing happend, try to uncomment those two next lines, try first one alone, then second one and both
// putenv("LANG={$lang}");
// putenv("LANGUAGE={$lang}");
setlocale(LC_ALL, $lang);

// Please rename your .po and .mo with the domain name
$domain = 'gettextexample';
// If you only clone the project, do not edit the second parameter. 
// Just put your locale folder path
bindtextdomain($domain, __DIR__ . "/../locale");
textdomain($domain);

// Display html code
print("<h1>" . _("Welcome to the gettext() example") . "</h1>");

// Display username
if($username == "Anonymous") {
  print("<p>" . _("You are not logued") . ".</p>");
} else {
  printf("<p>Hello %s!</p>", $username);
}

// Plurial display (please use GET param "count")
if($count > 0) {
  printf("<p>" . ngettext("There is only %d thing", "There are %d things", $count) . ".</p>", $count);
} else {
  print("<p>" . _("There is nothing") . ".</p>");
}

// Print test page
include_once "test.php";

// Debug mode (just display params
printf(_("<p><b>Debug mode</b><br /><i>\$username=%s<br />\$count=%d<br />\$lang=%s</i><p>"), $username, $count, $lang);

?>
