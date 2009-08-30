<div class="title">
  <h2><?php echo $form->getObject() instanceof Entrata ? __('Nuova entrata') : __('Nuova uscita') ?></h2>
</div>

<form action="<?php echo url_for('@document_sales_create')?>" method="post">
  <table class="banca">
    <?php echo $form; ?>
    <tr>
      <td colspan="2" align="right"><?php echo submit_tag('Salva')?></td>
    </tr>
  </table>
</form>

<?php
  slot('sidebar');
    include_partial('cashflow/sidebar');
  end_slot();
?>