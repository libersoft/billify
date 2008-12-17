<?php echo select_tag('filters[stato]', options_for_select(array(
  '' => '',
  'attivo' => 'attivo',
  'disattivo' => 'disattivo',
), isset($filters['stato']) ? $filters['stato'] : '')) ?>