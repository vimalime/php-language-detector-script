<?
header('Content-Type: text/plain; charset=utf-8');

require_once 'Text/LanguageDetect.php';
$l = new Text_LanguageDetect();

//example text for language detection
$text = 'O mergina, vienplaukė, palaidomis kasomis, atlapu kaklu, smulkiu, bet tvirtu žingsniu ėjo toliau, artyn prie ežero.';

//Detects the closeness of a sample of text to the known languages
$result = $l->detect($text, 4);
print_r($result);

//Returns the distribution of unicode blocks in a given utf8 string
$blocks = $l->detectUnicodeBlocks($text, true);
print_r($blocks);

//language name
$l->setNameMode(0);
echo $l->detectSimple($text)."\n";

//ISO 639-1 two-letter language code
$l->setNameMode(2);
echo $l->detectSimple($text)."\n";

//ISO 639-2 three-letter language code
$l->setNameMode(3);
echo $l->detectSimple($text)."\n";

//Supported languages list
$l->setNameMode(0);
echo "Supported languages:\n";
$langs = $l->getLanguages();
sort($langs);
print_r($langs);

//Total amount of supported languages
echo count($langs);