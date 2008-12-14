<?php echo select_tag('modulo',options_for_select(array(
  'bacheca' => 'Bacheca',
  'clienti' => 'Clienti',
  'prodotti' => 'Prodotti',
  'fatture' => 'Fatture',
  'opzioni' => 'Opzioni',
),$bug->getModulo()))?>