<?php echo select_tag('filters[modulo]', options_for_select(array(
  '' => '',
  'bacheca' => 'Bacheca',
  'clienti' => 'Clienti',
  'prodotti' => 'Prodotti',
  'fatture' => 'Fatture',
  'opzioni' => 'Opzioni',
), isset($filters['modulo']) ? $filters['modulo'] : '')) ?>