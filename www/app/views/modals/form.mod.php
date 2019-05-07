<?php

    $values = isset($config['values']) ? $config['values'] : ($config['config']['method'] === "POST" ? $_POST : $_GET);

    $id = isset($values['id']) ? '?id='.$values['id'] : null;

?>

<?php if(isset($config['config']['header'])): ?>
    <h2 class="col-12"><?= $config['config']['header'] ?> </h2>
<?php endif ?>

<form method="<?= $config['config']['method']; ?>"
    <?= isset($config['config']['action']) ? 'action="' . $config['config']['action'] . $id . '"' : null; ?>
    class="form <?= $config['config']['class']; ?>"
    enctype="multipart/form-data">

    <?php foreach ($config['data'] as $keyName => $fieldValue) : ?>
		<div class="form-group <?= $fieldValue["div_class"] ?? '' ?>">

			<?php if (!empty($fieldValue["label"])) : ?>
				<label for="<?= $fieldValue["id"]; ?>">
					<?= $fieldValue["label"]; ?>
				</label>
			<?php endif;

		switch ($fieldValue["type"]): case "textarea":  ?>
				<textarea
                    rows="4"
                    cols="50"
                    name=<?= $fieldValue["name"] ?> id="<?= $fieldValue["id"]; ?>"
                    class="textarea-control <?php $value['class'] ?? ""  ?>"
                    <?= ($fieldValue["required"]) ? 'required="required"' : ''; ?>
                ><?= isset($values[$keyName]) ? htmlspecialchars($values[$keyName], ENT_QUOTES, 'UTF-8') : '' ?></textarea>
				<?php break;

			case "select": ?>
				<select
                    name="<?= $fieldValue["name"]; ?>"
                    id="<?= $fieldValue["id"]; ?>"
                    class="select-control <?= $fieldValue['class']; ?>">
					<?php foreach ($fieldValue['options'] as $option) : ?>
						<option <?= isset($values[$keyName]) ? $values[$keyName] === $option['value'] ? 'selected' : '' : null  ?> value="<?= $option['value']; ?>">
                            <?= $option['label']; ?>
                        </option>
					<?php endforeach ?>
				</select>
				<?php break;

			case "checkbox": ?>
				<label class="switch">
					<input name="<?= $fieldValue["name"] ?>" type="checkbox" value="1">
					<span class="slider round"></span>
				</label>
                <input type="hidden"  >
                <?php break;

			case "file": ?>
                <p>
                    <input
                        type="<?= $fieldValue["type"]; ?>"
                        id="<?= $fieldValue["id"]; ?>"
                        name="<?= $fieldValue["name"] ?>"
                        value="1" />
                    <input
                        type="hidden"
                        name="<?= $fieldValue["name"]; ?>"
                        value="file" />
                </p>
				<?php break;


			case "slug": ?>
				<div class="col-12">
					<div class="row">
						<span class="input-group-text col-3"><?= $fieldValue['presed']; ?>/</span>
						<input
                            class="input-control <?= $fieldValue["class"]; ?> col-9"
                            type="text"
                            id="<?= $fieldValue["id"]; ?>"
                            name="<?= $fieldValue["name"] ?>"
                            value="<?= isset($values[$keyName]) ? htmlspecialchars($values[$keyName], ENT_QUOTES, 'UTF-8') : '' ?>" />
					</div>
				</div>
				<?php break;

            case 'separator': ?>
                <hr>
                <?=(isset($fieldValue['after_title']) ? '<h3>'.$fieldValue['after_title'].'</h3>' : '')?>
                <?php break;

			default:
				if ($fieldValue["type"] === "password") {
					unset($values[$keyName]);
				} ?>

				<input
                    type="<?= $fieldValue["type"]; ?>"
                    name="<?= $fieldValue["name"]; ?>"
                    placeholder="<?= $fieldValue["placeholder"]; ?>"
                    class="<?= $fieldValue["class"]; ?>" id="<?= $fieldValue["id"]; ?>" <?= ($fieldValue["required"]) ? 'required="required"' : ''; ?>
                    value="<?= isset($values[$keyName]) ? htmlspecialchars($values[$keyName], ENT_QUOTES, 'UTF-8') : '' ?>">
				<?php break;

		endswitch; ?>

		</div>
	<?php endforeach; ?>

	<div class="col-12 col-md-6">
		<?php if(isset($config['btn'])): foreach ($config['btn'] as $btn) :

			if ($btn["type"] !== "a") : ?>
				<input type="<?= $btn["type"] ?>" class="<?= $btn["class"] ?>" value="<?= $btn['text']; ?>" />

			<?php else : ?>

				<a class="<?= $btn["class"] ?>" href="<?= $config['action'] ?>">
					<?= $btn['text']; ?>
				</a>

			<?php endif;
	endforeach; endif; ?>
        <a class="<?= $config["class"] ?>" href="<?= $config['action'] ?>">
            <?= $config['submit'] ?? ''; ?>
        </a>
	</div>

</form>