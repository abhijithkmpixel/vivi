<?php
$get_more_title = get_field('get_more_title', 'options');
$block_items = get_field('block_items', 'options');
if($block_items):
?>
<section class="get-more" data-scroll-section>
	<div class="container">
    <div class="cta-wrap">
      <div class="overlay">

        <?php if($get_more_title): ?>
        <div class="title center">
          <?php if($get_more_title['title']): ?>
          <h2><?php echo $get_more_title['title']; ?> <span class="vivi"><img src="<?php echo $get_more_title['image']['url']; ?>" width="102px" height="88px" alt="<?php echo $get_more_title['alt']; ?>" /></span></h2>
          <?php endif; ?>
        </div>
        <?php endif; ?>

        <div class="content">
          <div class="flex">
            <?php foreach( $block_items as $block_item ): ?>
            <div class="col">
              <div class="block-cta">
                <h4><i class="icon <?php echo $block_item['icon']; ?>"></i> <span><?php echo $block_item['title']; ?></span></h4>
                <p><?php echo $block_item['short_description']; ?></p>
                <?php if($block_item['link_url'] && $block_item['link_title']): ?>
                <a href="<?php echo $block_item['link_url']; ?>" class="btn btn-small btn-primary-light btn-hover-white"><?php echo $block_item['link_title']; ?></a>
                <?php else: ?>
                <br/> <br/>
                <?php endif; ?>
              </div>
            </div>
            <?php endforeach; ?>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php endif; ?>