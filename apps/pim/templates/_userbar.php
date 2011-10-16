<?php if ($sf_user->isAuthenticated()) : ?>
  <ul class="nav secondary-nav">
    <li><a href="#" onclick="return false;" id="nav-active">
      <?php echo __('welcome %user%', array('%user%' => (string)$sf_user))?>
    </a> </li>
<li class="dropdown" data-dropdown="dropdown">
<a href="#" class="dropdown-toggle"><?php echo __('edit'); ?></a>
<ul class="dropdown-menu">
<li>
    <?php echo link_to(__('profile'), '@user_edit')?> </li>
<li>    <?php echo link_to(__('preferences'), '@preferences')?> </li>
<li>    <?php echo link_to(__('logout'), '@logout')?></li>
  </ul>
</ul>
<?php endif ?>
