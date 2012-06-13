<div class="title">
  <h2><?php if($form->isNew()): ?>Nuovo<?php else:?>Modifica<?php endif?> <?php echo strtolower(str_replace('Form', '', get_class($form))) ?></h2>
</div>

<form action="<?php echo url_for('contact/create')?>" method="post">
  <table class="edit" width="100%">
    <?php echo $form; ?>
    <tr>
      <td colspan="2" align="right"><input type="submit" value="Salva" /></td>
    </tr>
  </table>
</form>

<?php
  slot('sidebar');
    include_partial('contact/sidebar');
  end_slot();
?>

