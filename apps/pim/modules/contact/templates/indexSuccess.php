<h2><?php echo $sf_request->getParameter('type') == ContattoPeer::CLASSKEY_FORNITORE ? 'Fornitori' : 'Clienti'?></h2>

<?php if(count($contacts) > 0):?>
  <table class="fatture">
  <thead>
  <tr>
    <th>Ragione Sociale</th>
    <th>Contatto</th>
    <th>E-Mail</th>
    <th>Telefono</th>
    <th>Fax</th>
    <th></th>
  </tr>
  </thead>
  <tbody>
  <?php foreach ($contacts as $contact): ?>
    <tr>
      <td><?php echo link_to($contact->getRagioneSociale(), 'contact/edit?id='.$contact->getId()) ?></td>
      <td style="text-align: left"><?php echo $contact->getContatto() ?></td>
      <td><?php echo $contact->getEmail() ?></td>
      <td><?php echo $contact->getTelefono() ?></td>
      <td><?php echo $contact->getFax() ?></td>
      <td><?php echo link_to(image_tag('icons_tango/trash-full.png', 'alt=delete'), 'contact/delete?id='.$contact->getId(), 'post=true&confirm=vuoi cancellare questo contatto? title=delete') ?></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
  </table>
<?php else:?>
  <p>Nessun contatto disponibile, <?php echo link_to('inserisci un contatto', 'contact/create?type='.$sf_request->getParameter('type'))?>.</p>
<?php endif?>
