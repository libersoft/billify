<?php include_partial('contact/sidebar');?>

<?php include_partial('invoice/sidebar');?>

<?php include_partial('cashflow/sidebar');?>



<?php /*<h2>Riepilogo</h2>

<table width="100%">
  <tr>
    <td valign="top">
      <p><strong>Fatturato annuo:</strong> <?php echo format_currency($fatturato_annuo_netto, 'EUR') ?> (<?php echo format_currency($fatturato_annuo, 'EUR') ?>)</p>
      <p><strong>Fatturato annuo incassato:</strong> <?php echo format_currency($fatturato_annuo_netto_incassato,'EUR') ?>  (<?php echo format_currency($fatturato_annuo_incassato, 'EUR') ?>)</p>
      <?php if(UtentePeer::getImpostazione()->getBoolDepositaIva()) { ?>
        <p><strong>Situazione deposito Iva:</strong> <?php echo format_currency($iva_depositata,'EUR')?>  depositata - <?php echo format_currency($iva_da_depositare,'EUR')?>  da depositare</p>
      <?php } ?>

      <?php if( (int) UtentePeer::getImpostazione()->getRitenutaAcconto()) { ?>
        <p><strong>Ritenuta d'acconto versata:</strong> <?php echo format_currency($ritenuta_acconto,'EUR')?></p>
      <?php } ?>
    </td>
    <td valign="top">
      <p><strong class="red">Fatture da incassare:</strong> <?php echo $conta_fatture_da_incassare ?></p>
      <p><strong class="red">Iva da pagare:</strong> <?php echo format_currency($iva, 'EUR') ?>  (A debito: <?php echo format_currency($iva_a_debito,'EUR') ?>  - A credito: <?php echo format_currency(($iva - $iva_a_debito),'EUR')?>)</p>
      <!--p><strong class="red">Inps da Pagare:</strong> <?php echo format_currency($inps,'EUR') ?></p -->
      <p><strong class="red">Totale da incassare:</strong> <?php echo format_currency($totale_da_incassare_netto, 'EUR')?> (<?php echo format_currency($totale_da_incassare, 'EUR')?> )</p>

    </td>
  </tr>
</table>*/ ?>