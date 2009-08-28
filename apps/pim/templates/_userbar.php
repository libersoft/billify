<?php if ($sf_user->isAuthenticated()) : ?>
  <div id="nav">
    <a href="#" onclick="return false;" id="nav-active">
      <?php echo __('welcome %firstname% %lastname%', array('%firstname%' => $sf_user->getAttribute('nome'),
                                                            '%lastname%' => $sf_user->getAttribute('cognome')))?>
    </a> <span>|</span>
    <?php echo link_to(__('profile'), '@user_edit')?> <span>|</span>
    <?php echo link_to(__('preferences'), '@preferences')?> <span>|</span>
    <?php echo link_to(__('logout'), '@logout')?>
  </div>
<?php endif ?>