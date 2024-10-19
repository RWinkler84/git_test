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

    <script type="text/javascript" src="scripts/chart.js"></script>
    <canvas id="myChart" width="400" height="200"></canvas>
    <script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['2000', '2001', '2002', '2003', '2004', '2005'],
            datasets: [{
                label: '# of babies',
                data: [12, 19, 3, 5, 2, 3]
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    </script>

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