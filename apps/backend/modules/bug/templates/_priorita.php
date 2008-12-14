<?php echo select_tag('filters[priorita]', options_for_select(array(
  '' => '',
  'bassa' => 'Bassa',
  'media' => 'Media',
  'alta' => 'Alta',
), isset($filters['priorita']) ? $filters['priorita'] : '')) ?>