<h2>Nuova fattura</h2>

<p><a href="<?php echo url_for('@fatture_acquisto')?>">Torna alla lista fatture fornitori</a></p>

<form action="<?php echo url_for('@fatture_acquisto_create')?>" method="post">

<fieldset>
  <legend>Dati Fattura</legend>

  <table class="banca">
    <?php echo $form; ?>
    <tr>
      <td colspan="2" align="right"><?php echo submit_tag('Salva')?></td>
    </tr>
  </table>
</fieldset>

</form>

<?php
  slot('sidebar');
    include_partial('invoice/sidebar');
  end_slot();
?>