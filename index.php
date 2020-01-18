<?php
header('Content-Type: text/plain; charset=utf-8');
 
require_once 'Text/LanguageDetect.php';
$l = new Text_LanguageDetect();
 
//example text for language detection
$text = 'अपने दक्षिण भारत की सबसे पहचानी जाने वाली इमारतो में से एक है ';
 
//Detects the closeness of a sample of text to the known languages
$result = $l->detect($text, 4);
print_r($result);
 
//Returns the distribution of unicode blocks in a given utf8 string
$blocks = $l->detectUnicodeBlocks($text, true);
print_r($blocks);
 
//language name
$l->setNameMode(0);
echo 'Detected two-letter Langage Name: '.$l->detectSimple($text)."\n";
 
//ISO 639-1 two-letter language code
$l->setNameMode(2);
echo 'Detected Langage Code: '.$l->detectSimple($text)."\n";
 
//ISO 639-2 three-letter language code
$l->setNameMode(3);
echo 'Detected three-letter Langage Code: '.$l->detectSimple($text)."\n";
 
//Supported languages list
$l->setNameMode(0);
echo "Supported languages:\n";
$langs = $l->getLanguages();
sort($langs);
print_r($langs);
 
//Total amount of supported languages
echo count($langs);