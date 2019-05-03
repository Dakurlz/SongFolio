<?php
    debug($config)
?>

<div rol="alert" class="alert alert-<?= $config['type'] ?>">
    <?= $config['message'] ?? '' ?>
    <?php if (isset($config['messages'])) : ?>
        <ul>
            <?php foreach ($config['messages'] as $key => $error) : ?>
                <li> <?= $error ?> </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>