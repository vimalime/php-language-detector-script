<?
header('Content-Type: text/plain; charset=utf-8');

require_once 'Text/LanguageDetect.php';
$l = new Text_LanguageDetect();

mb_internal_encoding("UTF-8");

//example content page
$url = "http://lt.wikipedia.org/wiki/Kalba";
$page = file_get_contents($url);

//parse page charset
preg_match('/<meta[^>]+charset=[\'"]*([a-z0-9\-]+)[\'"]*/i', $page, $a);
print_r($a);

if(!$a){
	$charset = "UTF-8";
}else{
	$charset = strtoupper($a[1]);
}

//remove whitespace, html tags and javascript from page content
$search = array('#<script[^>]*?>.*?</script>#si',	// Strip out javascript
		'#<style[^>]*?>.*?</style>#siU',			// Strip style tags properly
		'#<[\/\!]*?[^<>]*?>#si',					// Strip out HTML tags
		'#<![\s\S]*?--[ \t\n\r]*>#',				// Strip multi-line comments including CDATA
		'#\s\s+#'									// Strip whitespace
);
$content = preg_replace($search, '', $page);

//First 200 simbols of text content should be enough for language detection
$content = mb_substr($content, 0, 200);

//convert to utf-8 encoding if necessary
if($charset != "UTF-8"){
	$content = iconv($charset, "UTF-8", $content);
}

//Output content
echo $content."\n";

//language name
$l->setNameMode(2);
echo $l->detectSimple($content)."\n";

//closeness languages
$result = $l->detect($content, 4);
print_r($result);

//distribution of unicode blocks
$blocks = $l->detectUnicodeBlocks($content, true);
print_r($blocks);