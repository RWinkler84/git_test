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

    <?php
        $chartYears = [];
        $chartCounts = [];
        foreach($namesFiltered AS $nameArray) {
            $chartYears[] = $nameArray['year'];
            $chartCounts[] = $nameArray['count'];
        }
    ?>
    <?php /*
    <pre><?php print_r($chartYears); ?></pre>
    <pre><?php print_r($chartCounts); ?></pre>
    */ ?>

    <pre></pre>

    <script type="text/javascript" src="scripts/chart.js"></script>
    <canvas id="myChart" width="400" height="200"></canvas>
    <script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: <?php echo json_encode($chartYears); ?>,
            datasets: [{
                label: '# of babies',
                data: <?php echo json_encode($chartCounts); ?>,
                borderColor: 'rgb(75, 192, 192)',
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