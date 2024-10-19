<?php

require __DIR__ . '/inc/functions.php';

$content = "Hallo Welt\n \n \nHallo Mars";
// $content = 'Ich bin nur ein Absatz!';


// echo nl2br(e($content));
/*
var_dump(explode("\n", $content));

$paragraphs = explode("\n", $content);

echo '<p>' . implode('</p><p>', $paragraphs) . '</p>';
*/

$paragraphs = explode("\n", $content);
$filteredParagraphs = [];
foreach ($paragraphs AS $paragraph) {
    $paragraph = trim($paragraph);
    if (strlen($paragraph) > 0) {
        $filteredParagraphs[] = $paragraph;
    }
}
var_dump($filteredParagraphs);

?>

<?php foreach($filteredParagraphs AS $p): ?>
    <p><?php echo e($p); ?></p>
<?php endforeach; ?>