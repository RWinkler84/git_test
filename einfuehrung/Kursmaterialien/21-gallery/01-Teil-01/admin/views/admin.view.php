<?php /* <pre><?php var_dump($images); ?></pre> */ ?>
<?php if(!empty($images)): ?>
    <table>
        <thead>
            <tr>
                <th>Bild</th>
                <th>Titel</th>
                <th>Aktionen</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($images AS $image): ?>
                <tr>
                    <td><img src="../images/<?php echo $image->src; ?>" style="width: 10rem;" /></td>
                    <td><?php echo e($image->title); ?></td>
                    <td>@TODO</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php /*
    <div class="image-gallery">
        <?php foreach($images AS $image): ?>
            <figure class="image-gallery-item">
                <img class="image-gallery-image" src="../images/<?php echo $image->src; ?>" />
                <figcaption><?php echo e($image->title); ?></figcaption>
            </figure>
        <?php endforeach; ?>
    </div>
    */ ?>
<?php else: ?>
    <p>Es wurden bisher noch keine Bilder erfasst.</p>
<?php endif; ?>