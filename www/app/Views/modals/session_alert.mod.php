<?php if(isset($_SESSION['alert'])): ?>
    <?php foreach($_SESSION['alert'] as $type => $alerts): ?>
        <div rol="alert" class="alert alert-<?= $type ?>">
            <ul>
                <?php foreach($alerts as $key => $alert_content): ?>
                    <li> <?= $alert_content ?> </li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endforeach; ?>
    <?php unset($_SESSION['alert']); ?>
<?php endif; ?>