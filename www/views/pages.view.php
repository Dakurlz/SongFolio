<div class="admin-page">
  <!-- <h3>Type</h3>
  <select class="select-control">
    <option>
      Page
    </option>
    <option>Article</option>
    <option>Album</option>
    <option>Single </option>
  </select>

  <h3>Titre</h3>
  <input type="text" class="input-control input-control-success" name="title" />

  <br />

  <h3>lien permanent</h3>
  <input type="text" class="input-control input-control-success" name="title" />

  <h3>Image</h3>
  <input type="file" />

  <h3>Contenu</h3>
  <form>
    <textarea name="editor1" id="editor1" rows="10" cols="80">
        This is my textarea to be replaced with CKEditor.
    </textarea>

  </form>
 -->


  <?php $this->addModal("form1", $configFormPage) ?>

  <script>
      CKEDITOR.replace("editor");
    </script>

</div>
