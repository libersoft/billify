<?php include_partial('global/breadcrumps', array('items' => array(link_to(__('Home'), 'main/index'),
                                                                   link_to(__('Category'), 'categoria/index'),
                                                                   __('Edit %name%',  array('%name%' => $categoria->getNome()))
                                                                    ))) ?>
