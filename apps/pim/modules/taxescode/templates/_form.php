<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>

<form action="<?php echo url_for('taxescode/'.($form->getObject()->isNew() ? 'create' : 'update').(!$form->getObject()->isNew() ? '?id='.$form->getObject()->getId() : '')) ?>" method="post" <?php $form->isMultipart() and print 'enctype="multipart/form-data" ' ?>>
<?php if (!$form->getObject()->isNew()): ?>
<input type="hidden" name="sf_method" value="put" />
<?php endif; ?>
  <table class="edit" width="100%">
    <tfoot>
      <tr>
        <td colspan="2">
          &nbsp;<a href="<?php echo url_for('taxescode/index') ?>"><?php echo __('Cancel')?></a>
          <?php if (!$form->getObject()->isNew()): ?>
            &nbsp;<?php echo link_to(__('Delete'), 'taxescode/delete?id='.$form->getObject()->getId(), array('method' => 'delete', 'confirm' => __('Are you sure?'))) ?>
          <?php endif; ?>
          <input type="submit" value="<?php echo __('Save')?>" />
        </td>
      </tr>
    </tfoot>
    <tbody>
      <?php echo $form ?>
    </tbody>
  </table>
</form>

<?php
  slot('sidebar');
    include_partial('taxescode/sidebar');
  end_slot();
?>
