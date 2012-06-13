<?php include_stylesheets_for_form($form) ?>

<?php use_helper('Asset') ?>

<div class="title">
  <h2><?php if($form->isNew()): ?>nuova<?php else:?>modifica<?php endif?> fattura di <?php echo strtolower(str_replace('Form', '', get_class($form))) ?></h2>
</div>

<form action="<?php echo url_for('fattura/edit')?>" method="post">
  <table class="edit" width="100%">
    <?php echo $form; ?>
    <tr>
      <td colspan="2" align="right"><input type="submit" value="Salva e vai ai dettagli" class='button_submit'/></td>
    </tr>
  </table>
</form>

<?php
  slot('sidebar');
    include_partial('invoice/sidebar');
  end_slot();
?>
