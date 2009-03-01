<?php use_helper('idPager') ?>

<h2><?php echo $sf_request->getParameter('type') == ContattoPeer::CLASSKEY_FORNITORE ? __('Fornitori') : __('Clienti')?></h2>

<?php if($pager->getNbResults()):?>
  <table class="fatture">
  <thead>
  <tr>
    <th><?php echo __('Ragione Sociale') ?></th>
    <th><?php echo ('Contatto') ?></th>
    <th><?php echo ('E-Mail') ?></th>
    <th><?php echo ('Telefono') ?></th>
    <th><?php echo ('Fax') ?></th>
    <th></th>
  </tr>
  </thead>
  <tbody>
  <?php foreach ($pager->getResults() as $contact): ?>
    <tr>
      <td><?php echo link_to($contact->getRagioneSociale(), 'contact/edit?id='.$contact->getId()) ?></td>
      <td style="text-align: left"><?php echo $contact->getContatto() ?></td>
      <td><?php echo $contact->getEmail() ?></td>
      <td><?php echo $contact->getTelefono() ?></td>
      <td><?php echo $contact->getFax() ?></td>
      <td><?php echo link_to(image_tag('icons_tango/trash-full.png', 'alt=delete'), 'contact/delete?id='.$contact->getId(), 'post=true&confirm='.__('vuoi cancellare questo contatto?').' title=delete') ?></td>
    </tr>
  <?php endforeach; ?>
  </tbody>
  </table>
  
  <?php echo pager($pager, $sf_request, array('class' => 'navigator')) ?>
  
<?php else:?>
  <p><?php echo __('Nessun contatto disponibile')?>, <?php echo link_to(__('inserisci un contatto'), 'contact/create?type='.$sf_request->getParameter('type'))?>.</p>
<?php endif?>
