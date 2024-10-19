<?php
include 'views/header.php';
include 'inc/names.php';
include 'inc/functions.php';


$currentName = $_GET['name'];

$namesFiltered = [];
foreach($names AS $nameArray) {
    if ($nameArray['name'] !== $currentName) {
        continue;
    }
    $namesFiltered[] = $nameArray;
}

?>


<?php if(!empty($namesFiltered)): ?>
    <h2>Geburtsstatistiken für <?php echo e($currentName); ?></h2>

    <table>
        <thead>
            <tr>
                <th>Jahr</th>
                <th>Anzahl Geburten</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($namesFiltered AS $nameArray): ?>
                <tr>
                    <td><?php echo $nameArray['year']; ?></td>
                    <td><?php echo $nameArray['count']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>

<?php

include 'views/footer.php';
?>