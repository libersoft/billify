<h1>Payment List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Id utente</th>
      <th>Num giorni</th>
      <th>Descrizione</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($modo_pagamento_list as $modo_pagamento): ?>
    <tr>
      <td><a href="<?php echo url_for('payment/edit?id='.$modo_pagamento->getId()) ?>"><?php echo $modo_pagamento->getId() ?></a></td>
      <td><?php echo $modo_pagamento->getIdUtente() ?></td>
      <td><?php echo $modo_pagamento->getNumGiorni() ?></td>
      <td><?php echo $modo_pagamento->getDescrizione() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('payment/new') ?>">New</a>
