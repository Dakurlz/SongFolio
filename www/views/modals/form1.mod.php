<?php
$data = isset($config['values']) ? $config['values'] :
    ($config['config']['method'] === "POST" ? $_POST : $_GET);
?>
<form method="<?php echo $config['config']['method']; ?>"
	<?php echo isset($config['config']['action']) ? 'action="' . $config['config']['action'] . '"' : null; ?>
	  class="<?php echo $config['config']['class']; ?>"
	  enctype="multipart/form-data"
>
	<?php foreach ($config['data'] as $key => $value): ?>
		<div class="col-12">
			<?php if (!empty($value["label"]) && $value["type"] !== "checkbox") : ?>
				<label class="col-12" for="<?php echo $value["id"]; ?>"><?php echo $value["label"]; ?></label>
			<?php endif;

            switch ($value["type"]) :
                case "textarea": ?>
					<textarea
						rows="4"
						cols="50"
						class="<?php echo $value["class"]; ?>"
						id="<?php echo $value["id"]; ?>"
						<?php echo ($value["required"]) ? 'required="required"' : ''; ?>
					>
						<?php echo isset($data[$key]) ? htmlspecialchars($data[$key], ENT_QUOTES, 'UTF-8') : '' ?>
					</textarea>
					<?php break;

                case "select": ?>
					<select class="<?php echo $value['class']; ?>" name="<?php echo $value['id']; ?>" id="<?php echo $value["id"]; ?>"
							form="<?php echo $config['config']['id']; ?>">
						<!-- <option selected disabled>"<?php echo $value["id"]; ?>"</option> -->
						<?php foreach ($value['option'] as $option): ?>
							<option value=""><?php echo $option; ?></option>
						<?php endforeach ?>
					</select>
					<?php break;

                case "checkbox": ?>
					<label class="" for="<?php echo $value["id"]; ?>"><?php echo $value["label"]; ?></label>
					<label class="switch">
						<input type="<?php echo $value["type"]; ?>">
						<span class="slider round"></span>
					</label>
					<?php break;

                case "file": ?>
					<p>Ajouter une image</p>
					<input type="<?php echo $value["type"]; ?>" id="<?php echo $value["id"]; ?>"
						   name="<?php echo $key; ?>"/>
					<?php break;

                default:
                    if ($value["type"] === "password") {
                        unset($data[$key]);
                    } ?>
					<input type="<?php echo $value["type"]; ?>"
						   name="<?php echo $key; ?>"
						   placeholder="<?php echo $value["placeholder"]; ?>"
						   class="<?php echo $value["class"]; ?>"
						   id="<?php echo $value["id"]; ?>"
						<?php echo ($value["required"]) ? 'required="required"' : ''; ?>
						   value="<?php echo isset($data[$key]) ? htmlspecialchars($data[$key], ENT_QUOTES, 'UTF-8') : '' ?>"
					>
					<?php break;
            endswitch; ?>
		</div>
	<?php endforeach; ?>

	<div class="col-12 col-md-6">
		<?php foreach ($config['btn'] as $btn):
            if ($btn["type"] !== "a") : ?>
				<input type="<?php echo $btn["type"] ?>" class="<?php echo $btn["class"] ?>"
					   value="<?php echo $btn['text']; ?>">
			<?php else: ?>
				<a class="<?php echo $btn["class"] ?>"
				   href="<?php echo $config['action'] ?>">
					<?php echo $btn['text']; ?>
				</a>
			<?php endif;
        endforeach; ?>
	</div>

</form>
