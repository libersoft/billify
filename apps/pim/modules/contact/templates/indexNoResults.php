<div class="title">
  <h2><?php echo $sf_request->getParameter('type') == ContattoPeer::CLASSKEY_FORNITORE ? __('Fornitori') : __('Clienti')?></h2>
</div>

<p><?php echo __('Nessun contatto disponibile')?>, <?php echo link_to(__('inserisci un contatto'), 'contact/create?type='.$sf_request->getParameter('type'))?>.</p>

<?php
  slot('sidebar');
    include_partial('contact/sidebar');
  end_slot();
?>