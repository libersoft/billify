<h2><?php echo __('Payment\'s types') ?></h2>

<table class="fatture">
  <thead>
    <tr>
      <th>Num giorni</th>
      <th>Descrizione</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($modo_pagamento_list as $modo_pagamento): ?>
    <tr>
      <td><a href="<?php echo url_for('payment/edit?id='.$modo_pagamento->getId()) ?>" title="<?php echo $modo_pagamento->getNumGiorni() ?>"><?php echo $modo_pagamento->getNumGiorni() ?></a></td>
      <td><?php echo $modo_pagamento->getDescrizione() ?></td>
      <td><?php echo link_to(image_tag('icons_tango/trash-full.png', 'alt=delete'), 'payment/delete?id='.$modo_pagamento->getId(), 'post=true&confirm='.__('are you sure?').' title=delete') ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php
  slot('sidebar');
    include_partial('payment/sidebar');
  end_slot();
?>