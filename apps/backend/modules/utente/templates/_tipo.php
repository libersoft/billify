<?php echo select_tag('filters[tipo]', options_for_select(array(
  '' => '',
  'demo' => 'demo',
  'base' => 'base',
  'pro' => 'pro',
), isset($filters['tipo']) ? $filters['tipo'] : '')) ?>