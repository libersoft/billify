<!--h2>Accedi a PIM</h2-->


<?php echo form_tag('login/login') ?>

<table class="sf_admin_list" align="center" style="width: 20%">
<tr>
<td colspan="2" align="center">
<?php if ($sf_request->hasErrors()): ?>
<div class="login_error">Identificazione fallita - riprova</div>
<?php else: ?>
&nbsp;
<?php endif ?>
</td>
</tr>
<tr>
<th><label for="login"><strong>Login:</strong></label></th>
<td><?php echo input_tag('login', $sf_params->get('login')) ?></td>
<tr>
<th><label for="password"><strong>Password:</strong></label></th>
<td><?php echo input_password_tag('password') ?></td>
</tr>
<tr>
<td colspan="2" align="center">
<?php echo submit_tag('Entra', 'class=default') ?></td>
</tr>
<tr>
</tr>
</table>
</form>
