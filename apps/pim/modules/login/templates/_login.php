<?php if(!$sf_user->isAuthenticated()):?>

<?php echo form_tag('login/login') ?>
<table class="login" width="100%">
<tr>
<td colspan="2" align="center">
<?php if ($sf_request->hasErrors()): ?>
<div class="login_error"><?php echo $sf_request->getError('login')?></div>
<?php else: ?>
&nbsp;
<?php endif ?>
</td>
</tr>
<?php if ($sf_request->hasAttribute('success')):?>
<tr>
<td colspan="2"><div class="login_error"><?php echo $sf_request->getAttribute('success')?></div></td>
</tr>
<?php endif?>
<tr>
<th width="10%"><label for="login"><strong>Login:</strong></label></th>
<td><?php echo input_tag('login', $sf_params->get('login'),array('size'=>15)) ?></td>
<tr>
<th><label for="password"><strong>Password:</strong></label></th>
<td><?php echo input_password_tag('password',null,array('size'=>15)) ?></td>
</tr>
<tr>
<td colspan="2" align="center">
<?php echo submit_tag('Entra', 'class=default') ?></td>
</tr>
<tr>
<td colspan="2" align="center">
<p><?php echo link_to('Hai dimenticato la password?','utente/forgetpassword')?></p>
</td>
</tr>
</table>
</form>

<?php if($adv):?>

<div style="text-align: center;margin-top: 15px;margin-left: 30px">
<script type="text/javascript"><!--
google_ad_client = "pub-7642942795359992";
google_ad_width = 200;
google_ad_height = 90;
google_ad_format = "200x90_0ads_al_s";
google_ad_channel = "";
google_color_border = "003240";
google_color_bg = "FFFFFF";
google_color_link = "003240";
google_color_text = "000000";
google_color_url = "008000";
//--></script>
<script type="text/javascript"
  src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
</div>
<?php endif?>

<?php else:?>

<?php endif?>
