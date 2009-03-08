<h2><?php echo __('Bank list') ?></h2>

<table class="fatture">
  <thead>
    <tr>
      <th>banca</th>
      <th>n. conto</th>
      <th>iban</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($banca_list as $banca): ?>
    <tr>
      <td><a href="<?php echo url_for('bank/edit?id='.$banca->getId()) ?>" title="<?php echo $banca->getNomeBanca() ?>"><?php echo $banca->getNomeBanca() ?></a></td>
      <td><?php echo $banca->getNumeroConto() ?></td>
      <td><?php echo $banca->getIban() ?></td>
      <td><?php echo link_to(image_tag('icons_tango/trash-full.png', 'alt=delete'), 'bank/delete?id='.$banca->getId(), 'post=true&confirm='.__('are you sure?').' title=delete') ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>