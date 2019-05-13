<?php
    use Songfolio\Core\Helper;
    $values = isset($config['values']) ? $config['values'] : ($config['config']['method'] === "POST" ? $_POST : $_GET);

    $id = isset($values['id']) ? '?id='.$values['id'] : null;

?>

<?php if(isset($config['config']['header'])): ?>
    <h1 class="col-12"><?= $config['config']['header'] ?> </h1>
<?php endif ?>

<form method="<?= $config['config']['method']; ?>"
    <?= isset($config['config']['action']) ? 'action="' . $config['config']['action'] . $id . '"' : null; ?>
    class="form <?= $config['config']['class'] ?? '' ?>"
    enctype="multipart/form-data">

    <?php foreach ($config['data'] as $keyName => $fieldValue) : ?>


        <?php if($fieldValue['type'] !== 'start_row' && $fieldValue['type'] !== 'end_row'): ?>

            <div class="form-group <?= $fieldValue["div_class"] ?? '' ?>">

			<?php if (!empty($fieldValue["label"]) && $fieldValue["type"]!== 'checkbox') : ?>
				<label for="<?= $fieldValue["id"] ?? '' ?>">
					<?= $fieldValue["label"]; ?>
				</label>
			<?php endif;


        switch ($fieldValue["type"]): 
        
        
            case "textarea":  ?>
				<textarea
                    rows="4"
                    cols="50"
                    name=<?= $fieldValue["name"] ?? '' ?> id="<?= $fieldValue["id"] ?? '' ?>"
                    class="textarea-control <?php $fieldValue['class'] ?? ""  ?>"
                    <?= ($fieldValue["required"]) ? 'required="required"' : ''; ?>
                >
                    <?= isset($values[$fieldValue["name"]]) ? htmlspecialchars($values[$fieldValue["name"]], ENT_QUOTES, 'UTF-8') : '' ?>
                </textarea>
				<?php break;


			case "select": ?>
				<select
                    name="<?= $fieldValue["name"] ?? '' ?>"
                    id="<?= $fieldValue["id"] ?? '' ?>"
                    class="select-control <?= $fieldValue['class'] ?? '' ?>">
					<?php foreach ($fieldValue['options'] as $option) : ?>
						<option <?= isset($values[$fieldValue["name"]]) ? $values[$fieldValue["name"]] === $option['value'] ? 'selected' : '' : null  ?> value="<?= $option['value']; ?>">
                            <?= $option['label']; ?>
                        </option>
					<?php endforeach ?>
				</select>
				<?php break;


			case "checkbox": ?>
				<div class="switch-control">
                    <label class="switch">
                        <input name="<?= $fieldValue["name"] ?>" type="checkbox" value="1" <?= isset($values[$fieldValue["name"]]) ? $values[$fieldValue["name"]] === '1' ? 'checked' : null : null  ?> >
                        <span class="slider round"></span>
                    </label>
                   <span class="switch-control__text"><?= $fieldValue["label"]; ?></span>
				</div>
                <?php break;


			case "file": ?>
            <?php $imageValues = isset($values[$fieldValue["name"]] ) ? $values[$fieldValue["name"]] !== null ? BASE_URL . $values[$fieldValue["name"]]  : null : null ?>

                <div class="box">
                    <input
                            type="file"
                            name="<?= $fieldValue["name"] ?? '' ?>"
                            id="file-2 <?= $fieldValue["id"] ?? '' ?>"
                            class="inputfile inputfile-2"
                            onchange="readURL(this);"
                            value="<?=$imageValues ?>"
                    >
                        <label for="file-2"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg>
                            <span> <?= $imageValues !== null ? Helper::getImageName($imageValues) : 'Choisir une image&hellip;' ?> </span>
                        </label>
                    <img  id="befor_upload" src="<?=  $imageValues?>" alt="" height="20%" width="30%" >
                </div>


                <?php break;


			case "slug": ?>
					<div class="slug">
						<span class="input-group-text"><?= $fieldValue['presed']; ?>/</span>
						<input
                            class="input-control <?= $fieldValue["class"]; ?>"
                            type="text"
                            id="<?= $fieldValue["id"] ?? '' ?>"
                            name="<?= $fieldValue["name"] ?? '' ?>"
                            <?= ($fieldValue["required"]) ? 'required="required"' : ''; ?>
                            value="<?= isset($values[$keyName]) ? htmlspecialchars($values[$fieldValue["name"]], ENT_QUOTES, 'UTF-8') : '' ?>" />
					</div>
                <?php break;
                
				
            case 'date': ?>
                <div class="<?= $fieldValue["class"] ?? '' ?>">
                    <p class="datetime">
                        <input 
                            name="<?= $fieldValue["name"] ?? '' ?>" 
                            type="date" 
                            class="date" 
                            <?= ($fieldValue["required"]) ? 'required="required"' : ''; ?>
                            value="<?= isset($values[$fieldValue["name"]]) ? date('Y-m-d', strtotime($values[$fieldValue["name"]])) : '' ?>"
                            />
                    </p>
                </div>
                <?php break;

            case 'time': ?>
            <div class="<?= $fieldValue["class"] ?? '' ?>">
                <p class="datetime">
                    <input 
                        name="<?= $fieldValue["name"] ?? '' ?>" 
                        type="time" 
                        class="time" 
                        <?= ($fieldValue["required"]) ? 'required="required"' : ''; ?>
                        value="<?= isset($values[$fieldValue["name"]]) ? $values[$fieldValue["name"]] : '' ?>"
                        />
                </p>
            </div>
            <?php break;


            case 'separator': ?>
                <div>
                    <hr>
                    <?=(isset($fieldValue['after_title']) ? '<h3 style="margin-bottom: 0px">'.$fieldValue['after_title'].'</h3>' : '')?>
                </div>
                <?php break;

			default:
				if ($fieldValue["type"] === "password") {
					unset($values[$fieldValue["name"]]);
				} ?>

				<input
                    type="<?= $fieldValue["type"] ?>"
                    name="<?= $fieldValue["name"] ?? '' ?>"
                    placeholder="<?= $fieldValue["placeholder"] ?? '' ?>"
                    class="<?= $fieldValue["class"] ?? '' ?>"
                    id="<?= $fieldValue["id"] ?? '' ?>" 
                    <?= ($fieldValue["required"]) ? 'required="required"' : ''; ?>
                    value="<?= isset($values[$fieldValue["name"]]) ? htmlspecialchars($values[$fieldValue["name"]], ENT_QUOTES, 'UTF-8') : '' ?>">
				<?php break;

        endswitch; ?>
        
        </div>


        <?php elseif($fieldValue['type'] === 'start_row') : ?>
            <div class="row">
        <?php endif; ?>
        
        
        <?php if($fieldValue['type'] === 'end_row'): ?>
            </div>
        <?php endif; ?> 

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