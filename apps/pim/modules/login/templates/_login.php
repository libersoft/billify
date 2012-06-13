<?php echo form_tag('login/login') ?>
<table class="login" width="100%">
  <tr>
    <td colspan="2" align="center">
      &nbsp;
      <?php if ($sf_user->hasFlash('login')): ?>
        <div class="login_error"><?php echo $sf_user->getFlash('login')?></div>
      <?php endif ?>
    </td>
   </tr>
  
<tr>
<th width="10%"><label for="login"><strong>Login:</strong></label></th>
<td><input type="text" name="login" id="login" value="" size="15" /></td>
<tr>
<th><label for="password"><strong>Password:</strong></label></th>
<td><input type="password" name="password" id="password" value="" size="15" /></td>
</tr>
<tr>
<td colspan="2" align="center">
<input type="submit" value="Entra" /></td>
</tr>
<tr>
<td colspan="2" align="center">
<!--p><?php echo link_to('Hai dimenticato la password?','utente/forgetpassword')?></p-->
</td>
</tr>
</table>
</form>
