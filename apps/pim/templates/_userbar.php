<?php if ($sf_user->isAuthenticated()) : ?>
  <div id="nav">
    <a href="#" onclick="return false;" id="nav-active">
      <?php echo __('welcome %user%', array('%user%' => (string)$sf_user))?>
    </a> <span>|</span>
    <?php echo link_to(__('profile'), '@user_edit')?> <span>|</span>
    <?php echo link_to(__('preferences'), '@preferences')?> <span>|</span>
    <?php echo link_to(__('logout'), '@logout')?>
  </div>
<?php endif ?>