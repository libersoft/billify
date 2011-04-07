<table class="edit" <?php echo isset($align) ? 'align="' . $align . '"' : '' ?> <?php echo isset($align) ? 'width="' . $width . '"' : '' ?> width="100%">
  <tr>
    <th><?php echo stripcslashes($sf_user->getSettings()->getLabelImponibile()); ?>:</th>
    <td align="right"><?php echo $fattura->getIncludiTasse() == 's' ? format_currency($fattura->getImponibileScorporato()) : format_currency($fattura->getImponibile()) ?> <?php echo isset($euro) ? $euro : '&euro;' ?></td>
  </tr>
  <?php if ($fattura->getSconto() != 0): ?>
    <tr>
      <th><?php echo stripcslashes($sf_user->getSettings()->getLabelSconto()); ?> <?php echo $fattura->getSconto() ?>%:</th>
      <td align="right">-<?php echo $fattura->getScontoTotale() ?> <?php echo isset($euro) ? $euro : '&euro;' ?></td>
    </tr>
  <?php endif ?>
  <?php if ($fattura->getSpeseAnticipate() != 0): ?>
    <tr>
      <th><?php echo stripcslashes($sf_user->getSettings()->getLabelSpese()); ?>:</th>
      <td align="right"><?php echo format_currency($fattura->getSpeseAnticipate()) ?> <?php echo isset($euro) ? $euro : '&euro;' ?></td>
    </tr>
  <?php endif ?>
  <?php if ($fattura->getCalcolaTasse() == 's'): ?>
    <?php foreach ($fattura->getTasseUlteriori() as $tassa_ulteriore): ?>
      <tr>
        <th><?php echo $tassa_ulteriore['nome'] ?>:</th>
        <td align="right"><?php echo format_currency($tassa_ulteriore['costo']) ?> <?php echo isset($euro) ? $euro : '&euro;' ?></td>
      </tr>
    <?php endforeach; ?>
  <?php endif ?>
  <tr>
    <th style="border-bottom: 1px solid #000;color: red"><?php echo stripcslashes($sf_user->getSettings()->getLabelImponibileIva()); ?>:</th>
    <td align="right" style="border-bottom: 1px solid #000;"><?php echo format_currency($fattura->getImponibileFineIva()) ?> <?php echo isset($euro) ? $euro : '&euro;' ?></td>
  </tr>
  <tr>
    <th><?php echo stripcslashes($sf_user->getSettings()->getLabelIva()); ?>:</th>
    <td align="right"><?php echo format_currency($fattura->getIva()) ?> <?php echo isset($euro) ? $euro : '&euro;' ?></td>
  </tr>
  <tr>
    <th><?php echo stripcslashes($sf_user->getSettings()->getLabelTotaleFattura()); ?>:</th>
    <td align="right"><?php echo format_currency($fattura->getTotale()) ?> <?php echo isset($euro) ? $euro : '&euro;' ?></td>
  </tr>
  <?php if ($fattura->checkWithHoldingTax()): ?>
    <tr>
      <th><?php echo stripcslashes($sf_user->getSettings()->getLabelRitenutaAcconto()); ?>:</th>
      <td align="right">
          <?php echo format_currency($fattura->getRitenutaAcconto()) ?> <?php echo isset($euro) ? $euro : '&euro;' ?>
      </td>
    </tr>
  <?php endif ?>
  <tr style="background-color: #CEE0E6">
    <th style="border-top: 1px solid #000;color: red;"><?php echo stripcslashes($sf_user->getSettings()->getLabelNettoLiquidare()); ?>:</th>
    <td align="right" style="border-top: 1px solid #000;"><?php echo format_currency($fattura->getNettoDaLiquidare()) ?> <?php echo isset($euro) ? $euro : '&euro;' ?></td>
  </tr>
</table>

<?php
//$fattura->setTotaleMem($fattura->getNettoDaLiquidare());
//$fattura->setImponibileMem($fattura->getImponibile());
//$fattura->save();
?>

