<h2><?php echo __('Nuova entrata')?></h2>

<p><a href="<?php echo url_for('cashflow/index')?>">Torna al cash flow</a></p>

<form action="<?php echo url_for('@document_sales_create')?>" method="post">

<fieldset>
  <legend>Dati Documento</legend>

  <table class="banca">
    <?php echo $form; ?>
    <tr>
      <td colspan="2" align="right"><?php echo submit_tag('Salva')?></td>
    </tr>
  </table>
</fieldset>

</form>