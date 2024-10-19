<?php if(empty($weather)): ?>
    <h2>Wetter konnte nicht abgerufen werden.</h2>
<?php else: ?>
    <h2>Temperatur in Budapest: <?php echo e($weather->temperature); ?>°C.</h2>
<?php endif; ?>