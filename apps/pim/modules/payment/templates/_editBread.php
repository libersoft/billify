<?php include_partial('global/breadcrumps', array('items' => array(link_to(__('Home'), 'main/index'),
                                                                   link_to(__('Payment\'s types'), 'payment/index'),
                                                                   __('Edit %name%',  array('%name%' => $payment->getDescrizione()))
                                                                    ))) ?>