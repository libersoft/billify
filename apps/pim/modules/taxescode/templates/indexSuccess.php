<div class="title">
  <h2><?php echo __('Taxes code list')?></h2>
</div>

<table width="100%">
  <thead>
    <tr>
      <th><?php echo __('name')?></th>
      <th><?php echo __('value')?></th>
      <th><?php echo __('description')?></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($codice_iva_list as $codice_iva): ?>
    <tr>
      <td><a href="<?php echo url_for('taxescode/edit?id='.$codice_iva->getId()) ?>" title="<?php echo __('tax code')?>"><?php echo $codice_iva ?></a></td>
      <td><?php echo $codice_iva->getValore() ?></td>
      <td><?php echo $codice_iva->getDescrizione() ?></td>
      <td class="trash"><?php echo link_to(image_tag('icons_tango/trash-full.png', 'alt=delete'), 'taxescode/delete?id='.$codice_iva->getId(), 'post=true&confirm='.__('are you sure?').' title=delete') ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php
  slot('sidebar');
    include_partial('taxescode/sidebar');
  end_slot();
?>