<h2>Seleziona Prodotto</h2>

<?php echo javascript_tag('
function inviaDati(value, prezzo){
	opener.document.fattura.desc'.$sf_request->getParameter('id').'.value = value;
	opener.document.fattura.prezzo'.$sf_request->getParameter('id').'.value = prezzo;
	opener.document.fattura.qty'.$sf_request->getParameter('id').'.value = 1;
}
')?>
<?php echo form_tag('#',array('name'=>'prodotto','onsubmit'=>'window.close()'))?>
<?php if(count($prodottos) > 0):?>
<table class="fatture">
<thead>
<tr>
  <th></th>
  <th>Codice</th>
  <th>Nome</th>
  <th>Prezzo</th>
</tr>
</thead>
<tbody>
<?php $i = 0; foreach ($prodottos as $prodotto): ?>
<tr>
    <td>
    <?php echo radiobutton_tag('prodotto',$prodotto->getCodice().' - '.$prodotto->getNome(),false,array('onClick'=>'inviaDati(this.value, document.prodotto.prezzo'.$i.'.value)'))?>
    <?php echo input_hidden_tag('prezzo'.$i,$prodotto->getPrezzo())?>
    </td>
	<td><?php echo $prodotto->getCodice() ?></td>
    <td style="text-align: left"><?php echo $prodotto->getNome() ?></td>
    <td><?php echo format_currency($prodotto->getPrezzo(),'&euro;') ?></td>
  </tr>
<?php $i++; endforeach; ?>
<tr>
<td colspan="5"><?php echo submit_tag('Fatto')?></td>
</tr>
</tbody>
</table>
</form>
<?php else:?>
<p>Nessun prodotto disponibile.</p>
<?php endif?>