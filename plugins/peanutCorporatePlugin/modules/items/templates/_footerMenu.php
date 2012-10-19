<ul>
<?php foreach ($items as $item): ?>
  <li>
    <?php if($item['type'] == 'link'): ?>

    <a href="<?php echo $item['url'] ?>" title="<?php echo __('Link to %title%', array('%title%' => $item['Translation'][$culture]['title']), 'peanutCorporate') ?>">
      <?php echo $item['Translation'][$culture]['title'] ?>
    </a>

    <?php else: ?>

    <a href="<?php echo url_for('item_show', array('slug' => $item['Translation'][$culture]['slug'], 'sf_format' => 'html')) ?>" title="<?php echo __('View this entry: %title%', array('%title%' => $item['Translation'][$culture]['title']), 'peanutCorporate') ?>">
      <?php echo $item['Translation'][$culture]['title'] ?>
    </a>
    
    <?php endif; ?>
  </li>
<?php endforeach; ?>
</ul>