<?php
$values = isset($config['values']) ? $config['values'] : ($config['config']['method'] === "POST" ? $_POST : $_GET);
?>

<form method="<?= $config['config']['method']; ?>" <?= isset($config['config']['action']) ? 'action="' . $config['config']['action'] . '"' : null; ?> class="form <?= $config['config']['class']; ?>" enctype="multipart/form-data">

	<?php foreach ($config['data'] as $keyName => $fieldValue) : ?>
		<div class="col-12">

			<?php if (!empty($fieldValue["label"]) && $fieldValue["type"] !== "checkbox") : ?>
				<label class="" for="<?= $fieldValue["id"]; ?>">
					<?= $fieldValue["label"]; ?>
				</label>
			<?php endif;

		switch ($fieldValue["type"]): case "textarea": ?>
				<textarea rows="4" cols="50" name=<?= $keyName ?> id="<?= $fieldValue["id"]; ?>" class="textarea-control <?php $value['class'] ?? ""  ?>" <?= ($fieldValue["required"]) ? 'required="required"' : ''; ?>>
								<?= isset($values[$keyName]) ? htmlspecialchars($values[$keyName], ENT_QUOTES, 'UTF-8') : '' ?>
						</textarea>
				<?php break;

			case "select": ?>
				<select name="<?= $keyName; ?>" id="<?= $fieldValue["id"]; ?>" class="select-control <?= $fieldValue['class']; ?>">
					<?php foreach ($fieldValue['options'] as $option) : ?>
						<option <?php $values[$keyName] === $option['value'] ? 'selected' : ''  ?> value="<?= $option['value']; ?>"><?= $option['label']; ?></option>
					<?php endforeach ?>
				</select>
				<?php break;

			case "checkbox": ?>
				<label class="col-12" for="<?= $fieldValue["id"]; ?>">
					<?= $fieldValue["label"]; ?>
				</label>
				<label class="switch">
					<input type="<?= $fieldValue["type"]; ?>">
					<span class="slider round"></span>
				</label>
				<?php break;

			case "file": ?>
				<p>Ajouter une image</p>
				<input type="<?= $fieldValue["type"]; ?>" id="<?= $fieldValue["id"]; ?>" name="<?= $keyName; ?>" />
				<?php break;


			case "slug": ?>
				<div class="col-12">
					<div class="row">
						<span class="input-group-text col-3"><?= $fieldValue['presed']; ?></span>
						<input class="input-control <?= $fieldValue["class"]; ?> col-9" type="text" id="<?= $fieldValue["id"]; ?>" name="<?= $keyName ?>" value="<?= isset($values[$keyName]) ? htmlspecialchars($values[$keyName], ENT_QUOTES, 'UTF-8') : '' ?>" />
					</div>
				</div>
				<?php break;

			default:
				if ($fieldValue["type"] === "password") {
					unset($values[$keyName]);
				} ?>

				<input type="<?= $fieldValue["type"]; ?>" name="<?= $keyName; ?>" placeholder="<?= $fieldValue["placeholder"]; ?>" class="<?= $fieldValue["class"]; ?>" id="<?= $fieldValue["id"]; ?>" <?= ($fieldValue["required"]) ? 'required="required"' : ''; ?> value="<?= isset($values[$keyName]) ? htmlspecialchars($values[$keyName], ENT_QUOTES, 'UTF-8') : '' ?>">
				<?php break;

		endswitch; ?>

		</div>
	<?php endforeach; ?>

	<div class="col-12 col-md-6">
		<?php foreach ($config['btn'] as $btn) :

			if ($btn["type"] !== "a") : ?>
				<input type="<?= $btn["type"] ?>" class="<?= $btn["class"] ?>" value="<?= $btn['text']; ?>" />

			<?php else : ?>

				<a class="<?= $btn["class"] ?>" href="<?= $config['action'] ?>">
					<?= $btn['text']; ?>
				</a>

			<?php endif;
	endforeach; ?>
	</div>

</form>