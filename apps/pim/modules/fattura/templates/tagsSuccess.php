<h2>Tags Fatture</h2>

<div>
<?php if(count($tags)>0):?>
<ul id="tag_cloud">
  <?php foreach($tags as $tag => $count): ?>
  <li class="tag_popularity_<?php echo $count ?>"><?php echo link_to($tag, '@invoice?tag='.$tag, 'rel=tag') ?></li>
  <?php endforeach; ?>
</ul>
<?php else:?>
<p>Nessun Tag</p>
<?php endif?>
</div>