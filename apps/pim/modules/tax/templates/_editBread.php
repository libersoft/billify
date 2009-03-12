<?php include_partial('global/breadcrumps', array('items' => array(link_to(__('Home'), 'main/index'), 
                                                                                                                    link_to(__('Taxes'), 'tax/index'), 
                                                                                                                    __('Edit %name%',  array('%name%' => $tax->getNome())) 
                                                                                        ))) ?>