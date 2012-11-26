<div class="title">
  <h2><?php echo __('Categoria') ?></h2>
</div>

<table width="100%">
  <thead>
    <tr>
      <th><?php echo __('Name')?></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($categoria_list as $categoria): ?>
    <tr>
      <td><a href="<?php echo url_for('categoria/edit?id='.$categoria->getId()) ?>" title="<?php echo $categoria->getNome() ?>"><?php echo $categoria->getNome() ?></a></td>
      <td class="trash"><?php echo link_to(image_tag('icons_tango/trash-full.png', 'alt=delete'), 'categoria/delete?id='.$categoria->getId(), 'post=true&confirm='.__('are you sure?').' title=delete') ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php
  slot('sidebar');
    include_partial('categoria/sidebar');
  end_slot();
?>
