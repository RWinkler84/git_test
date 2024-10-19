<pre><?php
$str = 'abcdefghijklmnopqrstuvwxyz';

var_dump(str_starts_with($str, 'abc'));
var_dump(str_ends_with($str, 'abc'));

echo "------\n";

var_dump(strlen($str));
var_dump(substr($str, 4, 10));
var_dump(substr($str, 4));
// var_dump(strpos($str, 'efh'));


echo "------\n";

var_dump(strtoupper('Hallo Welt'));
var_dump(strtolower('Hallo Welt'));
var_dump(ucfirst('hallo welt'));

echo "------\n";

var_dump(trim('    !hallo welt!    '));
var_dump(trim('    !hallo welt!    ', ' !'));
var_dump(ltrim('    !hallo welt!    '));
var_dump(rtrim('    !hallo welt!    '));

echo "------\n";

$str = 'Hallo Welt! Hallo Welt';

var_dump(str_replace('Hallo', 'hey', $str));
var_dump(str_replace(['Hallo', 'Welt'], ['Hey', 'Mars'], $str));

echo "------\n";

function e($html) {
    return htmlspecialchars($html, ENT_QUOTES, 'UTF-8', true);
}

$text = "Hallo Welt\nHier <strong>geht</strong> jetzt der Text weiter";
echo $text;
?></pre>

<?php /* echo str_replace("\n", "<br />", $text); */ ?>
<?php echo nl2br(e($text)); ?>
