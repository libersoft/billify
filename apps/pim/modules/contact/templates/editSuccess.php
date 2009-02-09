<h2>Nuovo fornitore</h2>

<p><a href="<?php echo url_for('@fornitori')?>">Torna alla lista fornitori</a></p>

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

