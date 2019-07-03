<?php if(isset($_SESSION['alert'])): ?>
    <?php foreach($_SESSION['alert'] as $type => $alerts): ?>
        <div rol="alert" style="padding: 10px 0" class="alert alert-<?= $type ?>">
            <ul>
                <?php foreach($alerts as $alert_content): ?>
                    <li> <?=  $alert_content ?> </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endforeach; ?>
    <?php unset($_SESSION['alert']); ?>
<?php endif; ?>
