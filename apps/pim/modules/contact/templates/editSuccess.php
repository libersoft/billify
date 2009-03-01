<h2><?php if($form->isNew()): ?>Nuovo<?php else:?>Modifica<?php endif?> <?php echo strtolower(str_replace('Form', '', get_class($form))) ?></h2>

<p><a href="<?php echo url_for($form->getRoute())?>">Torna alla lista</a></p>

<form action="<?php echo url_for('contact/create')?>" method="post">

<fieldset>
  <legend>Dati Fornitore</legend>

  <table class="banca">
    <?php echo $form; ?>
    <tr>
      <td colspan="2" align="right"><?php echo submit_tag('Salva')?></td>
    </tr>
  </table>
</fieldset>

</form>

