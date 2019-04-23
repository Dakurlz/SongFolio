<?php
$data = isset($config['values']) ? $config['values'] : ($config['config']['method'] === "POST" ? $_POST : $_GET);
?>
<form method="<?= $config['config']['method']; ?>" <?= isset($config['config']['action']) ? 'action="' . $config['config']['action'] . '"' : null; ?> class="<?= $config['config']['class']; ?>" enctype="multipart/form-data">
  <?php foreach ($config['data'] as $key => $value) : ?>
    <div class="col-12 <?= $value["id"]; ?>">
      <?php if (!empty($value["label"]) && $value["type"] !== "checkbox") : ?>
        <label class="" for="<?= $value["id"]; ?>"><?= $value["label"]; ?></label>
      <?php endif;

    switch ($value["type"]): case "textarea": ?>
        <textarea rows="4" cols="50" class="textarea-control <?php $value['class'] ?? ""  ?>" name="<?= $value["id"]; ?>" id="<?= $value["id"]; ?>" <?= ($value["required"]) ? 'required="required"' : ''; ?>>
                        <?= isset($values[$key]) ? htmlspecialchars($values[$key], ENT_QUOTES, 'UTF-8') : '' ?>
                    </textarea>
        <?php break;

      case "select": ?>
        <select class="select-control <?= $value['class']; ?>" name="<?= $value['id']; ?>" id="<?= $value["id"]; ?>">
          <!-- <option selected disabled>"<?php
                                          ?>"</option> -->
          <?php foreach ($value['options'] as $option) : ?>
            <option value="<?= $option['value']; ?>"><?= $option['label']; ?></option>
          <?php endforeach ?>
        </select>
        <?php break;

      case "checkbox": ?>
        <label class="col-12" for="<?= $value["id"]; ?>"><?= $value["label"]; ?></label>
        <label class="switch">
          <input type="<?= $value["type"]; ?>">
          <span class="slider round"></span>
        </label>
        <?php break;

      case "file": ?>
        <input class="<?= $value["class"]; ?>" type="<?= $value["type"]; ?>" id="<?= $value["id"]; ?>" name="<?= $key; ?>" />
        <?php break;

      case "slug": ?>
        <div class="col-12">
          <div class="row">
            <span class="input-group-text col-3"><?= $value['presed']; ?></span>
            <input class="input-control <?= $value["class"]; ?> col-9" type="text" id="<?= $value["id"]; ?>" name="<?= $value["id"]; ?>" />
          </div>
        </div>

        <?php break;

      default:
        if ($value["type"] === "password") {
          unset($values[$key]);
        } ?>
        <input type="<?= $value["type"]; ?>" name="<?= $key; ?>" placeholder="<?= $value["placeholder"]; ?>" class="<?= $value["class"]; ?>" id="<?= $value["id"]; ?>" <?= ($value["required"]) ? 'required="required"' : ''; ?> value="<?= isset($values[$key]) ? htmlspecialchars($values[$key], ENT_QUOTES, 'UTF-8') : '' ?>">
        <?php break;
    endswitch; ?>
    </div>
  <?php endforeach; ?>

  <div class="col-12 col-md-6">
    <?php foreach ($config['btn'] as $btn) :
      if ($btn["type"] !== "a") : ?>
        <input type="<?= $btn["type"] ?>" class="<?= $btn["class"] ?>" value="<?= $btn['text']; ?>">
      <?php else : ?>
        <a class="<?= $btn["class"] ?>" href="<?= $config['action'] ?>">
          <?= $btn['text']; ?>
        </a>
      <?php endif;
  endforeach; ?>
  </div>

</form>